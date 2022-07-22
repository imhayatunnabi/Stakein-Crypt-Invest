<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CoinGateController extends Controller
{

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

                $trans = new Transaction();
                $trans->email = $order->customer_email;
                $trans->amount = $order->invest;
                $trans->type = "Invest";
                $trans->txnid = $order->order_number;
                $trans->user_id = $order->user_id;
                $trans->save();

                return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');

            }
        }
    }


    public function deposit(Request $request)
    {
        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        $generalsettings = Generalsetting::findOrFail(1);
        
        $blockinfo    = PaymentGateway::whereKeyword('coingate')->first();
        $blocksettings= $blockinfo->convertAutoData();
        $secret = $blocksettings['secret_string'];

        if($order->invest > 0){

        $acc = $user;
        $item_number = $order->order_number;

        $item_amount = $order->invest;
        $currency_code = $order->currency_code;


        $item_name = $generalsettings->title." Invest";


        $my_callback_url = route('api.invest.coingate.notify');
        
        $return_url = route('user.invest.send',$order->order_number);
        $cancel_url = route('user.invest.send',$order->order_number);


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
                $order->method = $request->method;
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
