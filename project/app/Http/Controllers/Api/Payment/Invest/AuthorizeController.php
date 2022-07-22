<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{

    public function store(Request $request){
        if(!$request->has('order_number')){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
        
        $order_number = $request->order_number;
        $order = Order::where('order_number',$order_number)->firstOrFail();

        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        $settings = Generalsetting::find(1);
        
        $authorizeinfo    = PaymentGateway::whereKeyword('authorize.net')->first();
        $authorizesettings= $authorizeinfo->convertAutoData();

        $item_name = $settings->title." Order";
        $item_number = Str::random(4).time();
        $item_amount = $order->invest;
        
     
        $validator = Validator::make($request->all(),[
            'cardNumber' => 'required',
            'cardCVC' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->passes()) {
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName($authorizesettings['login_id']);
            $merchantAuthentication->setTransactionKey($authorizesettings['txn_key']);

            $refId = 'ref' . time();

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber(str_replace(' ','',$request->cardNumber));
            $year = $request->year;
            $month = $request->month;
            $creditCard->setExpirationDate($year.'-'.$month);
            $creditCard->setCardCode($request->cardCVC);

            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
        
            $orderr = new AnetAPI\OrderType();
            $orderr->setInvoiceNumber($item_number);
            $orderr->setDescription($item_name);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction"); 
            $transactionRequestType->setAmount($item_amount);
            $transactionRequestType->setOrder($orderr);
            $transactionRequestType->setPayment($paymentOne);
  
            $requestt = new AnetAPI\CreateTransactionRequest();
            $requestt->setMerchantAuthentication($merchantAuthentication);
            $requestt->setRefId($refId);
            $requestt->setTransactionRequest($transactionRequestType);
        
            $controller = new AnetController\CreateTransactionController($requestt);
            if($authorizesettings['sandbox_check'] == 1){
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else {
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);                
            }

        
            if ($response != null) {
                if ($response->getMessages()->getResultCode() == "Ok") {
                    $tresponse = $response->getTransactionResponse();

                
                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $addionalData = ['item_number'=>$item_number,'txnid'=>$tresponse->getTransId()];

                        $order->payment_status = 'completed';
                        $order->txnid = $tresponse->getTransId();
                        $order->method = $request->method;
                        $date = Carbon::now();
                        $date = $date->addDays($order->days);
                        $date = Carbon::parse($date)->format('Y-m-d h:i:s');
                        $order->end_date = $date;
                        $order->update();

                        $trans = new Transaction();
                        $trans->email = $order->customer_email;
                        $trans->amount = $order->invest;
                        $trans->type = "Invest";
                        $trans->txnid = $order->order_number;
                        $trans->user_id = $order->user_id;
                        $trans->save();

                        return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest amount successfully!');
                    } else {
                        return back()->with('unsuccess', 'Payment Failed.');
                    }
                } else {
                    return back()->with('unsuccess', 'Payment Failed.');
                }      
            } else {
                return back()->with('unsuccess', 'Payment Failed.');
            }

        }
        return back()->with('unsuccess', 'Invalid Payment Details.');
    }
}
