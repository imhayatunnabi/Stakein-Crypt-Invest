<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\PaymentGateway;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class CoinGateController extends Controller
{
    public function blockInvest()
    {
        return view('front.coinpay');
    }

    public function coingetCallback(Request $request)
    {
        $fpbt = fopen('coin-payment'.time().'.txt', 'w');
        fwrite($fpbt, json_encode($request->all(),true));
        fclose($fpbt);
        return true;

        $trans_id = $request->order_id;

        if ($request->status == 'paid') {
            if (Order::where('order_number',$request->order_id)->where('payment_status','pending')->first()){

                $deposits = $request->receive_amount;

                $order = Order::where('order_number',$request->order_id)->where('payment_status','pending')->first();
                $data['pay_amount'] = $deposits;
                $data['coin_amount'] = $request->pay_amount;
                $data['payment_status'] = "completed";
                $data['txnid'] = $request->token;
                $order->update($data);

                $notification = new Notification;
                $notification->order_id = $order->id;
                $notification->save();

                $trans = new Transaction;
                $trans->email = $order->customer_email;
                $trans->amount = $order->invest;
                $trans->type = "Invest";
                $trans->txnid = $order->order_number;
                $trans->user_id = $order->user_id;
                $trans->save();

                $notf = new UserNotification;
                $notf->user_id = $order->user_id;
                $notf->order_id = $order->id;
                $notf->type = "Invest";
                $notf->save();

                $gs =  Generalsetting::findOrFail(1);

                if($gs->is_affilate == 1)
                {
                    $user = User::find($order->user_id);
                    if ($user->referral_id != 0)
                    {
                        $val = $order->invest / 100;
                        $sub = $val * $gs->affilate_charge;
                        $sub = round($sub,2);
                        $ref = User::find($user->referral_id);
                        if(isset($ref))
                        {
                            $ref->income += $sub;
                            $ref->update();

                            $trans = new Transaction;
                            $trans->email = $ref->email;
                            $trans->amount = $sub;
                            $trans->type = "Referral Bonus";
                            $trans->txnid = $order->order_number;
                            $trans->user_id = $ref->id;
                            $trans->save();
                        }
                    }
                }

                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => $order->customer_email,
                        'type' => "Invest",
                        'cname' => $order->customer_name,
                        'oamount' => $order->order_number,
                        'aname' => "",
                        'aemail' => "",
                        'wtitle' => "",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendAutoMail($data);
                }
                else
                {
                    $to = $order->customer_email;
                    $subject = " You have invested successfully.";
                    $msg = "Hello ".$order->customer_name."!\nYou have invested successfully.\nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);
                }

            }
        }
    }


    public function deposit(Request $request)
    {
        $generalsettings = Generalsetting::findOrFail(1);
        
        $blockinfo    = PaymentGateway::whereKeyword('coingate')->first();
        $blocksettings= $blockinfo->convertAutoData();
        $secret = $blocksettings['secret_string'];

        if($request->invest > 0){

        $acc = Auth::user();
        $item_number = Str::random(4).time();;

        $item_amount = $request->invest;
        $currency_code = $request->currency_code;


        $item_name = $generalsettings->title." Invest";


        $my_callback_url = route('coingate.notify');
        
        $return_url = route('front.payreturn');
        $cancel_url = route('payment.cancle');


            \CoinGate\CoinGate::config(array(
                'environment'               => 'sandbox',
                'auth_token'                => $secret
            ));


            $post_params = array(
                'order_id'          => $item_number,
                'price_amount'      => $item_amount,
                'price_currency'    => $currency_code,
                'receive_currency'  => $currency_code,
                'callback_url'      => $my_callback_url,
                'cancel_url'        => $cancel_url,
                'success_url'       => $return_url,
                'title'             => $item_name,
                'description'       => 'Deposit'
            );

            $coinGate = \CoinGate\Merchant\Order::create($post_params);
        
            if ($coinGate)
            {

                $order = new Order;

                $order['pay_amount'] = $request->total;
                $order['user_id'] = $request->user_id;
                $order['invest'] = $request->invest;
                $order['method'] = $request->method;
                $order['customer_email'] = $request->customer_email;
                $order['customer_name'] = $request->customer_name;
                $order['customer_phone'] = $request->customer_phone;
                $order['order_number'] = $item_number;
                $order['customer_address'] = $request->customer_address;
                $order['customer_city'] = $request->customer_city;
                $order['customer_zip'] = $request->customer_zip;
                $order['payment_status'] = "pending";
                $order['notify_id'] = $coinGate->token;
                $order['currency_sign'] = $request->currency_sign;
                $order['subtitle'] = $request->subtitle;
                $order['title'] = $request->title;
                $order['details'] = $request->details;

                $date = Carbon::now();
                $date = $date->addDays($request->days);
                $date = Carbon::parse($date)->format('Y-m-d h:i:s');
                $order['end_date'] = $date;
                $order->save();

                return redirect($coinGate->payment_url);

            }
            else
            {
                return redirect()->back()->with('unsuccess','Some Problem Occurrs! Please Try Again');
            }

        }
        return redirect()->back()->with('unsuccess','Please enter a valid amount.')->withInput();
    }

}
