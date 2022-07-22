<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Models\Generalsetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParisiBankController extends Controller
{
    private $orderRepositorty;
    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){

        $settings = Generalsetting::findOrFail(1);
        $order = new Order();
        $paypal_email = $settings->paypal_business;
        $return_url = route('front.payreturn');
        $cancel_url = route('payment.cancle');
        $notify_url = route('parisi.notify');

        $item_name = $settings->title." Order";
        $item_number = Str::random(4).time();
        $item_amount = $request->invest;
       
        $addionalData = ['item_number'=>$item_number];
        $this->orderRepositorty->order($request,'pending',$addionalData);

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
            $order->update();

            $this->orderRepositorty->callAfterOrder($request,$order);
        }
    }
}
