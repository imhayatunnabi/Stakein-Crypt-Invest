<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    public $public_key;
    private $secret_key;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $this->public_key = $paydata['public_key'];
        $this->secret_key = $paydata['secret_key'];
    }

    public function store(Request $request) {
        if(!$request->has('order_number')){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
        
        $order_number = $request->order_number;
        $order = Order::where('order_number',$order_number)->firstOrFail();

        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        $item_number = $order_number;
        $item_amount = $order->invest;

        $curl = curl_init();

        $customer_email =  $request->customer_email;
        $amount = $item_amount;  
        $currency = $order->currency_code;
        $txref = $item_number;
        $PBFPubKey = $this->public_key;
        $redirect_url = route('api.invest.flutter.notify');
        $payment_plan = "";

        $order->customer_email = $request->email;
        $order->customer_name = $request->name;
        $order->customer_phone = $request->phone;
        $order->customer_city = $request->city;
        $order->customer_zip = $request->zip;
        
        $order->method = $request->method;
        $order->save();
        Session::put('order_number',$item_number);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount' => $amount,
              'customer_email' => $customer_email,
              'currency' => $currency,
              'txref' => $txref,
              'PBFPubKey' => $PBFPubKey,
              'redirect_url' => $redirect_url,
              'payment_plan' => $payment_plan
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          if($err){
            die('Curl returned error: ' . $err);
          }
          
          $transaction = json_decode($response);
          
          if(!$transaction->data && !$transaction->data->link){
            print_r('API returned error: ' . $transaction->message);
          }
          
          return redirect($transaction->data->link);

     }


     public function notify(Request $request) {

        $input = $request->all();
        $order_number = Session::get('order_number');
 
        $order = Order::where('order_number',$order_number)->where('payment_status','pending')->first();


        if($request->cancelled == "true"){
          return redirect()->route('user.dashboard')->with('success',__('Payment Cancelled!'));
        }


        if (isset($input['txref'])) {
            $ref = $input['txref'];
            $query = array(
                "SECKEY" => $this->secret_key,
                "txref" => $ref
            );

            $data_string = json_encode($query);
              
            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
            $response = curl_exec($ch);
            curl_close($ch);
            $resp = json_decode($response, true);

            if ($resp['status'] == "success") {

              $paymentStatus = $resp['data']['status'];
              $chargeResponsecode = $resp['data']['chargecode'];

              if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($paymentStatus == "successful")) {
      
                  $order->payment_status = "completed";
                  $order->txnid = $resp['data']['txid'];
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
              
              }
              else {
                return redirect()->route('user.invest.send',$order->order_number)->with('unsuccess','Something went wrong!');
              }

            }
        }
        else {
            return redirect()->route('user.invest.send',$order->order_number)->with('unsuccess','Something went wrong!');
          }

     }
}
