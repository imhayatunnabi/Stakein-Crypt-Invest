<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Classes\Instamojo;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\PaymentGateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\UserNotification;
use App\Models\Notification;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class InstamojoController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $gs = Generalsetting::first();
        $total =  $request->invest;
        $paydata = $data->convertAutoData();

        if($request->currency_code != "INR")
        {
            return redirect()->back()->with('unsuccess',__('Please Select INR Currency For This Payment.'));
        }


        $order['item_name'] = $gs->title." Order";
        $order['item_number'] = Str::random(4).time();
        $order['item_amount'] = $total;
        $cancel_url = route('payment.cancle');
        $notify_url = route('instamojo.notify');

        if($paydata['sandbox_check'] == 1){
        $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
        $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $order['item_name'],
                "amount" => $order['item_amount'],
                "send_email" => true,
                "email" => $request->customer_email,
                "redirect_url" => $notify_url
            ));
            $redirect_url = $response['longurl'];

        Session::put('input_data',$input);
        Session::put('order_data',$order);
        Session::put('order_payment_id', $response['id']);

        return redirect($redirect_url);

        }
        catch (Exception $e) {
            return redirect($cancel_url)->with('unsuccess','Error: ' . $e->getMessage());
        }
    }


    public function notify(Request $request)
    {
        $input_data = $request->all();

        $payment_id = Session::get('order_payment_id');

        if($input_data['payment_status'] == 'Failed'){
            return redirect()->route('front.checkout')->with('error','Something went wrong!');
        }

        if ($input_data['payment_request_id'] == $payment_id) {

            $addionalData = ['txnid'=>$payment_id];
            $this->orderRepositorty->OrderFromSession($request,'complete',$addionalData);

            return redirect()->route('front.payreturn');

        }
        return redirect()->route('front.checkout')->with('error','Something went wrong!');
    }
}
