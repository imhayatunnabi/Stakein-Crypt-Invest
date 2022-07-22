<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class BlockChainController extends Controller
{
    public function index()
    {
        return view('payblocktrail');
    }


    public function blockchainInvest()
    {
        return view('frontend.blockchain');
    }


    public function chaincallback()
    {

        $blockinfo    = PaymentGateway::whereKeyword('blockChain')->first();
        $blocksettings= $blockinfo->convertAutoData();
        $real_secret  = $blocksettings['secret_string'];

        $des = $_SERVER['QUERY_STRING'];

        $bitTran = $_GET['transaction_hash'];
        $bitAddr = $_GET['address'];

        $trans_id = Input::get('transx_id');
        $getSec = Input::get('secret');
        if ($real_secret == $getSec){

            if (Order::where('order_number',$trans_id)->exists()){

                $deposits = $_GET['value']/100000000;

                $order = Order::where('order_number',$trans_id)->first();
                $data['txnid'] = $bitTran;
                $data['pay_amount'] = $deposits;
                $data['payment_status'] = "completed";
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



                return "*ok*";

            }

        }
    }


    function goRandomString($length = 10) {
        $characters = 'abcdefghijklmnpqrstuvwxyz123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }


    public function accept($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $transid = strtoupper($this->goRandomString(4).Str::random(3).$this->goRandomString(4));

        $receivertrans = new Transaction();
        $receivertrans['transid'] = $transid;
        $receivertrans['mainacc'] = $withdraw->acc->id;
        $receivertrans['accto'] = null;
        $receivertrans['accfrom'] = null;
        $receivertrans['type'] = "withdraw";
        $receivertrans['sign'] = "-";
        $receivertrans['reference'] = "Payout Withdraw Successful";
        $receivertrans['reason'] = "Withdraw Payouts";
        $receivertrans['amount'] = $withdraw->amount;
        $receivertrans['fee'] = $withdraw->fee;
        $receivertrans['withdrawid'] = $withdraw->id;
        $receivertrans['trans_date'] = date('Y-m-d H:i:s');
        $receivertrans['status'] = 1;
        $receivertrans->save();

        $data['status'] = "completed";
        $withdraw->update($data);

        return redirect('admin/withdraws')->with('message','Withdraw Accepted Successfully');
    }

    public function deposit(Request $request)
    {
        $blockinfo = PaymentGateway::whereKeyword('blockChain')->first();
        $blocksettings= $blockinfo->convertAutoData();
        if($request->invest > 0){

        $acc = Auth::user()->id;
            $item_number = Str::random(4).time();;

        $item_amount = $request->invest;
        $currency_code = $request->currency_code;
        
        try {
            $amount = file_get_contents('https://blockchain.info/tobtc?currency='.$currency_code.'&value='.$request->invest);
        } catch (\Throwable $th) {
            $amount = file_get_contents('https://blockchain.info/tobtc?currency=USD&value='.$request->invest);
        }
        

        $secret = $blocksettings['secret_string'];
        $my_xpub = $blocksettings['blockchain_xpub'];
        $my_api_key = $blocksettings['blockchain_api'];
        $my_gap = $blocksettings['gap_limit'];
        $my_callback_url = url('/').'/blockchain/notify?transx_id='.$item_number.'&secret='.$secret;
                $ttt = 'https://www.google.com/';
        $root_url = 'https://api.blockchain.info/v2/receive';

        $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($ttt). '&key='.$my_api_key.'&gap_limit='.$my_gap;
            
        $response = file_get_contents($root_url . '?' . $parameters);
        
        $object = json_decode($response);
       
        $address = $object->address;

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
            $order['currency_sign'] = $request->currency_sign;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();


        session(['address' => $address,'amount' => $amount,'currency_value' => $item_amount,'currency_sign' => $request->currency_sign,'accountnumber' => $acc]);
        return redirect()->route('blockchain.invest');


        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();
    }

    public function getDepositCount()
    {
        $deposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->count();
        return $deposits;
    }

    public function getDepositData()
    {
        $deposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->orderBy('id','desc')->first();
        $totaldeposits = Deposit::where('accid',Auth::user()->id)->where('status','pending')->count();
        return response()->json([
                'status' => 'success',
                'amount' => $deposits->amount,
                'count' => $totaldeposits,
                'confirms' => 2,
                'message' => '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Successfully Deposited '.$deposits->amount.' BTC</strong></div>'
            ]
            ,200);
    }


}
