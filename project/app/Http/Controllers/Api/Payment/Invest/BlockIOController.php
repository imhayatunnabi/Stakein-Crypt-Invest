<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Classes\BlockIO;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\User;

class BlockIOController extends Controller
{
    public function blockioInvest()
    {
        return view('user.order.blockio');
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

                $user = User::findOrFail($order->user_id);

                if ($order->coin_amount <= $amountRec) {
                    $data['txnid'] = $bitTran;
                    $data['payment_status'] = "completed";
                    $order->update($data);

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
        
        $input = $request->all();
        $settings = Generalsetting::findOrFail(1);
     
        $order = Order::where('order_number',$request->order_number)->first();

        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        if($order->invest > 0){

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
        
            $acc = $user->id;
            $item_number = $order->order_number;

            $item_amount = $order->invest;
            $currency_code = $order->currency_code;
            
            $blockchain    = PaymentGateway::whereKeyword('blockChain')->first();
            $blockchain= $blockchain->convertAutoData();
            $secret = $blockchain['secret_string'];


             $my_callback_url = route('api.invest.blockio.notify');


            $block_io = new BlockIO($my_api_key, $secret, $version);

            $biorate = 1;
        
            $coin_amount = round($item_amount / $biorate, 8);

            $root_url = 'https://block.io/api/v2/';
            $addObject = $block_io->get_new_address(array());

            $address = $addObject->data->address;
        
            $notifyObject = $block_io->create_notification(array('type' => 'address', 'address' =>$address , 'url' =>"https://dev.geniusocean.net/geniuscrypto/blockio/notify" ));

            $notifyID = $notifyObject->data->notification_id;

            $order->method = $request->method;

            $date = Carbon::now();
            $date = $date->addDays($request->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();
            							
            $qrcode_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:".$address."?amount=".$coin_amount."&choe=UTF-8";


            session(['address' => $address,'coin' => $coin,'qrcode_url' => $qrcode_url,'amount' => $coin_amount,'currency_value' => $item_amount,'currency_sign' => $curr->sign,'accountnumber' => $acc]);

            return redirect()->route('api.invest.blockio.invest');


        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();

    }
}
