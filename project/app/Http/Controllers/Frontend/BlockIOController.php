<?php

namespace App\Http\Controllers\Frontend;

use App;
use URL;
use Auth;
use Hash;
use Config;
use Session;
use Redirect;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Classes\BlockIO;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Classes\CoinPaymentsAPI;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\PaymentGateway;
use App\Repositories\OrderRepository;
use Illuminate\Support\Str;

class BlockIOController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function blockioInvest()
    {
        return view('frontend.blockio');
    }

    public function blockiocallback(Request $request)
    {


        $fpbt = fopen('blockIO-Response'.time().'.txt', 'w');
        fwrite($fpbt, json_encode($request->all(),true));
        fclose($fpbt);
        return true;
        $notifyID = $request['notification_id'];
        $amountRec = $request['data']['amount_received'];
        $bitTran = $request['data']['txid'];


            if (Order::where('notify_id',$notifyID)->exists()){
                $order = Order::where('notify_id',$notifyID)->where('payment_status','pending')->first();

                if ($order->coin_amount <= $amountRec) {
                    $data['txnid'] = $bitTran;
                    $data['payment_status'] = "completed";
                    $order->update($data);

                    $this->orderRepositorty->callAfterOrder($request,$order);
                }
            }

        
    }

    function curlGetCall($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec ($ch);
        curl_close ($ch);

        return $data;
    }


    public function invest(Request $request)
    {
        $blockinfo    = PaymentGateway::whereKeyword('block.io.btc')->first();
        $blocksettings= $blockinfo->convertAutoData();
        
        
        if($request->invest > 0){

            $methods = $request->method;
            $version = 2;
            $coin = "BTC";
            $my_api_key = $blocksettings['blockio_api_btc'];
        

             if($methods == "block.io.ltc"){
                $blockinfo    = PaymentGateway::whereKeyword('block.io.ltc')->first();
                $blocksettings= $blockinfo->convertAutoData();
                $coin = "Litecoin";
                $my_api_key = $blocksettings['blockio_api_ltc'];

            }elseif ($methods == "block.io.dgc"){
                $coin = "Dogecoin";
                $blockinfo    = PaymentGateway::whereKeyword('block.io.dgc')->first();
                $blocksettings= $blockinfo->convertAutoData();
                $my_api_key = $blocksettings['blockio_api_dgc'];

            }
        
            $acc = Auth::user()->id;
            $item_number = Str::random(4).time();;

            $item_amount = $request->invest;
            $currency_code = $request->currency_code;
            
            $blockchain    = PaymentGateway::whereKeyword('blockChain')->first();
            $blockchain= $blockchain->convertAutoData();
            $secret = $blockchain['secret_string'];


             $my_callback_url = route('blockio.notify');


            $block_io = new BlockIO($my_api_key, $secret, $version);

            $biorate = 1;
        
            $coin_amount = round($item_amount / $biorate, 8);

            $root_url = 'https://block.io/api/v2/';
            $addObject = $block_io->get_new_address(array());

            $address = $addObject->data->address;
        
            $notifyObject = $block_io->create_notification(array('type' => 'address', 'address' =>$address , 'url' =>"https://dev.geniusocean.net/geniuscrypto/blockio/notify" ));

            $notifyID = $notifyObject->data->notification_id;
            $order = new Order;

            $order['pay_amount'] = $request->total;
            $order['user_id'] = $request->user_id;
            $order['invest'] = $request->invest;
            $order['method'] = $methods;
            $order['customer_email'] = $request->customer_email;
            $order['customer_name'] = $request->customer_name;
            $order['customer_phone'] = $request->customer_phone;
            $order['order_number'] = $item_number;
            $order['customer_address'] = $request->customer_address;
            $order['customer_city'] = $request->customer_city;
            $order['customer_zip'] = $request->customer_zip;
            $order['payment_status'] = "pending";
            $order['currency_sign'] = $request->currency_sign;
            $order['notify_id'] = $notifyID;
            $order['coin_address'] = $address;
            $order['coin_amount'] = $coin_amount;
            $order['subtitle'] = $request->subtitle;
            $order['title'] = $request->title;
            $order['details'] = $request->details;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();
            							
            $qrcode_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:".$address."?amount=".$coin_amount."&choe=UTF-8";


            session(['address' => $address,'coin' => $coin,'qrcode_url' => $qrcode_url,'amount' => $coin_amount,'currency_value' => $item_amount,'currency_sign' => $request->currency_sign,'accountnumber' => $acc]);

            return redirect()->route('blockio.invest');


        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();

    }

}
