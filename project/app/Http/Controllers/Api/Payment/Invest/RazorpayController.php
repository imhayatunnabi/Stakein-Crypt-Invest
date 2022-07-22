<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('Razorpay')->first();
        $paydata = $data->convertAutoData();

        $this->keyId = $paydata['key'];
        $this->keySecret =  $paydata['secret'];
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);
    }

    public function store(Request $request)
    {
          if(!$request->has('order_number')){
              return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
          }
          
            $order_number = $request->order_number;
            $order = Order::where('order_number',$order_number)->first();
            $curr = Currency::where('name','=',$order->currency_code)->first();

            if($curr->name != "INR"){
                 return redirect()->back()->with('unsuccess','Please Select INR Currency For Razorpay.');
            }
            $input = $request->all();
         
            $notify_url = route('api.invest.razorpay.notify');
         
            $settings = Generalsetting::findOrFail(1);
            
            $item_amount = $order->invest * $curr->value;
            
       
            $item_name = $settings->title." Deposit";
 
        $orderData = [
            'receipt'         => $order->order_number,
            'amount'          => round($item_amount) * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        
        $razorpayOrderId = $razorpayOrder['id'];
        
        session(['razorpay_order_id'=> $razorpayOrderId]);
                   
                    $order['method'] =$request->method;
                    $order->update();

                    $displayAmount = $amount = $orderData['amount'];
                    
                    if ($curr->name !== 'INR')
                    {
                        $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
                        $exchange = json_decode(file_get_contents($url), true);
                    
                        $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
                    }
                    
                    $checkout = 'automatic';
                    
                    if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
                    {
                        $checkout = $_GET['checkout'];
                    }
                    
                    $data = [
                        "key"               => $this->keyId,
                        "amount"            => $amount,
                        "name"              => $item_name,
                        "description"       => $item_name,
                        "prefill"           => [
							"name"              => $request->name,
							"email"             => $request->email,
							"contact"           => $request->phone,
                        ],
                        "notes"             => [
							"address"           => $request->address,
							"merchant_order_id" => $order->order_number,
                        ],
                        "theme"             => [
							"color"             => "{{$settings->colors}}"
                        ],
                        "order_id"          => $razorpayOrderId,
                    ];
                    
                    if ($this->displayCurrency !== 'INR')
                    {
                        $data['display_currency']  = $this->displayCurrency;
                        $data['display_amount']    = $displayAmount;
                    }
                    
                    $json = json_encode($data);
                    $displayCurrency = $this->displayCurrency;
                    
        return view( 'frontend.razorpay-checkout', compact( 'data','displayCurrency','json','notify_url' ) );
        
    }

    
	public function razorCallback( Request $request ) {

        
        $success = true;
        $razorpayOrder = $this->api->order->fetch(session('razorpay_order_id'));
        $order_id = $razorpayOrder['receipt'];
        $order = Order::where( 'order_number', $order_id )->first();
        $cancel_url = route('user.invest.send',$order->order_number);

        $error = "Payment Failed";
        
        if (empty($_POST['razorpay_payment_id']) === false)
        {
            //$api = new Api($keyId, $keySecret);
        
            try
            {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => session('razorpay_order_id'),
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
        
                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
        
        if ($success === true)
        {
            
            $razorpayOrder = $this->api->order->fetch(session('razorpay_order_id'));
        
            $order_id = $razorpayOrder['receipt'];
            $transaction_id = $_POST['razorpay_payment_id'];
            $order = Order::where( 'order_number', $order_id )->first();
       
            if (isset($order)) {
                $order->txnid = $transaction_id;
                $order->payment_status = 'completed';
              
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
            }
            return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest amount successfully!');

        }
        else
        {
            
            return redirect($cancel_url);
        }
        
    }
}
