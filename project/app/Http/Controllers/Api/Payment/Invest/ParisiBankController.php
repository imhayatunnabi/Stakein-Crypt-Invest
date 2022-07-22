<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ParisiBankController extends Controller
{
    public function store(Request $request){
        $input = $request->all();
        $settings = Generalsetting::findOrFail(1);
     
        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        $settings = Generalsetting::findOrFail(1);
        $paypal_email = $settings->paypal_business;
        $return_url = route('user.invest.send',$order->order_number);
        $cancel_url = route('api.invest.parisi.notify');
        $notify_url = route('user.invest.send',$order->order_number);

        $item_name = $settings->title." Order";
        $item_number = $order->order_number;
        $item_amount = $order->invest;
       
        $order->method = $request->method;
        $order->update();

        $parameters = [
            'custom' => $item_number,
            'currency_code' => $request->currency_code,
            'amount' => $item_amount,
            'details' => $item_name,
            'web_hook' => $notify_url,
            'cancel_url' => $cancel_url,
            'success_url' => $return_url, 
            'customer_email' => $request->customer_email,
        ];
        
        $url = 'https://script.appdevs.net/parisi-bank/payment/process';
        
        $authorization = "Authorization: Bearer 7809a8c4-225d-47ca-ad7d-af88dd6f6107";

        $res = Http::withToken('7809a8c4-225d-47ca-ad7d-af88dd6f6107')->post($url,$parameters);
        $parsiResponse = $res->json();
        return redirect($parsiResponse['url']);
    }

    public function notify(Request $request){
        $orderNumber = $request['custom'];
        
        if (Order::where('order_number',$orderNumber)->where('payment_status','pending')->exists()){
            $order = Order::where('order_number',$orderNumber)->where('payment_status','pending')->first();
            $order->payment_status = "completed";

            $date = Carbon::now();
            $date = $date->addDays($order->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order->end_date = $date;
            $order->update();

            $user = User::findOrFail($order->user_id);
            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $order->invest;
            $trans->type = "Invest";
            $trans->txnid = $order->order_number;
            $trans->user_id = $order->user_id;
            $trans->save();

            return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');
        }
    }
}
