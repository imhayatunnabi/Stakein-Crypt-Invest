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
use Carbon\Carbon;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoinbaseCommerce extends Controller{

    public function deposit(Request $request)
    {
        
        ApiClient::init('cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a');


        $newCheckoutObj = new Checkout();
        
        $newCheckoutObj->name = 'The Sovereign Individual';
        $newCheckoutObj->description = 'Mastering the Transition to the Information Age';
        $newCheckoutObj->pricing_type = 'fixed_price';
        $newCheckoutObj->local_price = [
            'amount' => '150.00',
            'currency' => 'USD'
        ];
        $newCheckoutObj->requested_info = ['name', 'email'];
        
        $item_number = Str::random(8);
        $newCheckoutObj->save();

        
                    $order = new Order();
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
                    $order['payment_status'] = "completed";
                    $order['currency_sign'] = $request->currency_sign;
                    $order['subtitle'] = $request->subtitle;
                    $order['title'] = $request->title;
                    $order['details'] = $request->details;
                    $order['status'] = "pending";
                    $order['txnid'] = $newCheckoutObj->id;
                

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
                    $notf->user_id = $request->user_id;
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
            
                return redirect('https://commerce.coinbase.com/checkout/'.$newCheckoutObj->id);
        
    }


    public function notify(Request $request)
    {
        try {
        $trans_id = $request->order_id;
      
        $deposits = $request->receive_amount;
        $order = Order::where('order_number',$trans_id)->where('payment_status','pending')->first();
        $data['pay_amount'] = $deposits;
        $data['coin_amount'] = $request->pay_amount;
        $data['payment_status'] = "completed";
        $data['txnid'] = $request->token;
        $order->update($data);
        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();
        } catch (\Throwable $th) {
 
        }
       
    }
}