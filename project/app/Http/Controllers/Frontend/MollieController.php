<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Session;
use Auth;
use Str;

class MollieController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){

   
        $item_amount = $request->invest;
        $input = $request->all();

        $item_name = "Deposit via Molly Payment";

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $request->currency_code,
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('molly.notify'),
            ]);

    
        Session::put('molly_data',$input);
        Session::put('payment_id',$payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }


    public function notify(Request $request){

        $input = Session::get('molly_data');
        $success_url = route('payment.return');
        $cancel_url = route('payment.cancle');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
      
        if($payment->status == 'paid'){
            $order = new Order();
            $order['pay_amount'] = $input['total'];
            $order['user_id'] = Auth::user()->id;
            $order['invest'] = $input['invest'];
            $order['method'] = $input['method'];
            $order['customer_email'] = $input['customer_email'];
            $order['customer_name'] = $input['customer_name'];
            $order['customer_phone'] = $input['customer_phone'];
            $order['order_number'] = Str::random(4).time();
            $order['customer_address'] = $input['customer_address'];
            $order['customer_city'] = $input['customer_city'];
            $order['customer_zip'] = $input['customer_zip'];
            $order['payment_status'] = "completed";
            $order['currency_sign'] = $input['currency_sign'];
            $order['subtitle'] = $input['subtitle'];
            $order['title'] = $input['title'];
            $order['details'] = $input['details'];
            $order['status'] = "pending";

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
            $notf->user_id = Auth::user()->id;
            $notf->order_id = $order->id;
            $notf->type = "Invest";
            $notf->save();


            $gs =  Generalsetting::findOrFail(1);

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

                        $trans = new Transaction();
                        $trans->email = $ref->email;
                        $trans->amount = $sub;
                        $trans->type = "Referral Bonus";
                        $trans->txnid = $order->order_number;
                        $trans->user_id = $ref->id;
                        $trans->save();
                    }
                }
            }      
            Session::forget('molly_data');
            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

        return redirect($cancel_url);
    }
}
