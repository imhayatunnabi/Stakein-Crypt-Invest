<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use App\Classes\Instamojo;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;

class InstamojoController extends Controller
{
    public function store(Request $request){

        if(!$request->has('order_number')){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
        
        $order_number = $request->order_number;
        $order = Order::where('order_number',$order_number)->firstOrFail();

        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();
    
        if($curr->name != "INR")
        {
            return redirect()->back()->with('unsuccess','Please Select INR Currency For Instamojo.');
        }
    
        $input = $request->all();
    

        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Order";
        $user_email = User::findOrFail($order->user_id)->email;
        
        $item_amount = $order->invest * $curr->value;

        $cancel_url = route('user.invest.send',$order->order_number);
        $notify_url = route('api.invest.instamojo.notify');

        $data = PaymentGateway::whereKeyword('Instamojo')->first();
        $paydata = $data->convertAutoData();

        if($paydata['sandbox_check'] == 1){
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $item_name,
                "amount" => round($item_amount,2),
                "send_email" => true,
                "email" => $user_email,
                "redirect_url" => $notify_url
                ));
            
            $redirect_url = $response['longurl'];
            $order->instamojo_id = $response['id'];
            $order->method = $request->method;
            $order->update();
        
        
            return redirect($redirect_url);
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
        
    }
    
    
    public function notify(Request $request){
    
        $data = $request->all();

        $order = Order::where('instamojo_id','=',$data['payment_request_id'])->first();
        $cancel_url = route('user.invest.send',$order->order_number);
     
    
        if (isset($order)) {

            $order->txnid = $data['payment_id'];
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

            return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest amount successfully!');
        }
    }
     
}
