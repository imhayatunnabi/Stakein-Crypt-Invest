<?php

namespace App\Http\Controllers\Api\Payment\Deposit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use PayPal\{
    Api\Item,
    Api\Payer,
    Api\Amount,
    Api\Payment,
    Api\ItemList,
    Rest\ApiContext,
    Api\Transaction,
    Api\RedirectUrls,
    Api\PaymentExecution,
    Auth\OAuthTokenCredential
};

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $paydata['client_id'];
        $paypal_conf['secret'] = $paydata['client_secret'];
        $paypal_conf['settings']['mode'] = $paydata['sandbox_check'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function store(Request $request)
    {
    
        if(!$request->has('deposit_number')){
             return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
        
        $input = $request->all();
        

        $deposit_number = $request->deposit_number;
        $order = Deposit::where('deposit_number',$deposit_number)->first();
        $curr = Currency::where('name','=',$order->currency_code)->first();
        
        $support = ['USD','EUR'];
        if(!in_array($curr->name,$support)){
            return redirect()->back()->with('unsuccess','Please Select USD Or EUR Currency For Paypal.');
        }
         
        $settings = Generalsetting::findOrFail(1);
        $item_amount = $order->amount * $curr->value;
    
            
        $settings = Generalsetting::findOrFail(1);
        $order['item_name'] = $settings->title." Order";
        $order['item_amount'] = $item_amount;
        $notify_url = route('api.deposit.paypal.notify');
        $cancel_url = route('user.deposit.send',$order->deposit_number);
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order['item_name']) /** item name **/
            ->setCurrency($curr->name)
            ->setQuantity(1)
            ->setPrice($order['item_amount']); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($curr->name)
            ->setTotal($order['item_amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order['item_name'].' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url) /** Specify return URL **/
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            return redirect()->back()->with('unsuccess',$ex->getMessage());
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_data',$input);
        Session::put('deposit_number',$deposit_number);
        Session::put('order_data',$order);
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return redirect()->back()->with('unsuccess','Unknown error occurred');
    }

    public function notify(Request $request)
    {

        $user = auth()->user();
        $deposit_data = Session::get('deposit_data');

        $payment_id = Session::get('paypal_payment_id');
        if (empty( $request['PayerID']) || empty( $request['token'])) {
            return redirect()->back()->with('error', 'Payment Failed'); 
        } 

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);


        $deposit_number = Session::get('deposit_number');

        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

                $order = Deposit::where('deposit_number',$deposit_number)->whereStatus('pending')->first();
                
                $order->method = "Paypal";
                $order->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                $order->status = "complete";
                $order->update();

                $user = auth()->user();
                $user->income += $order->amount;
                $user->save();

                Session::forget('deposit_data');
                Session::forget('paypal_payment_id');
                Session::forget('deposit_number');
                
            return redirect()->back()->with('success','Deposit amount successfully!');
        }

    }
}
