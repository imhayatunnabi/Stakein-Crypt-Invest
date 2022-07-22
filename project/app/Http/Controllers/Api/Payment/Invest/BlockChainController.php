<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;

class BlockChainController extends Controller
{
    public function blockchainInvest()
    {
        return view('user.order.blockchain');
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

                $trans = new Transaction();
                $trans->email = $order->customer_email;
                $trans->amount = $order->invest;
                $trans->type = "Invest";
                $trans->txnid = $order->order_number;
                $trans->user_id = $order->user_id;
                $trans->save();


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


    public function deposit(Request $request)
    {
        $blockinfo = PaymentGateway::whereKeyword('blockChain')->first();
        $blocksettings= $blockinfo->convertAutoData();

        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        if($order->invest > 0){

        $acc = $user->id;
        $item_number = $order->order_number;

        $item_amount = $order->invest;
        $currency_code = $order->currency_code;
        
        try {
            $amount = file_get_contents('https://blockchain.info/tobtc?currency='.$currency_code.'&value='.$order->invest);
        } catch (\Throwable $th) {
            $amount = file_get_contents('https://blockchain.info/tobtc?currency=USD&value='.$order->invest);
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
        $order->method = $request->method;
        $date = Carbon::now();
        $date = $date->addDays($request->days);
        $date = Carbon::parse($date)->format('Y-m-d h:i:s');
        $order['end_date'] = $date;
        $order->save();


        session(['address' => $address,'amount' => $amount,'currency_value' => $item_amount,'currency_sign' => $curr->sign,'accountnumber' => $acc]);
        return redirect()->route('api.invest.blockchain.invest');


        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();
    }


}
