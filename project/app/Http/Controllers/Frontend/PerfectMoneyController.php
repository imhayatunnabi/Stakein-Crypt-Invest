<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Classes\GetUserAgents;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerfectMoneyController extends Controller{


    public function deposit(Request $request)
    {
       
        header('Access-Control-Allow-Origin: https://perfectmoney.is');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
    
        if ($request->has('PAYMENT_ID') && $request->has('CUST_NUM')){
    
            $randString = new GetUserAgents();
            $transid = strtoupper($randString->goRandomString(4).Str::random(3).$randString->goRandomString(4));
    
            $settings = Generalsetting::findOrFail(1);
            $order = new Order();
            $item_name = $settings->title." Order";
            $item_number = Str::random(4).time();
         
            $order['pay_amount'] = $request->total;
            $order['user_id'] = $request->user_id;
            $order['invest'] = $request->invest;
            $order['method'] = $request->method;
            $order['customer_email'] = $request->customer_email;
            $order['customer_name'] = $request->customer_name;
            $order['customer_phone'] = $request->customer_phone;
            $order['order_number'] = $transid;
            $order['customer_address'] = $request->customer_address;
            $order['customer_city'] = $request->customer_city;
            $order['customer_zip'] = $request->customer_zip;
            $order['payment_status'] = "completed";
            $order['currency_sign'] = $request->currency_sign;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;
    
            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
    
            $order['end_date'] = $date;
            $order->save();
    
            $notification = new Notification();
            $notification->order_id = $order->id;
            $notification->save();
        
            $trans = new Transaction();
            $trans->email = $order->customer_email;
            $trans->amount = $order->invest;
            $trans->type = "Invest";
            $trans->txnid = $order->order_number;
            $trans->user_id = $order->user_id;
            $trans->save();
    
        
            $notf = new UserNotification();
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