<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\CoinPaymentsAPI;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use App;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Str;
use URL;
use Redirect;

class CoinPaymentController extends Controller
{
    public function coinCallback(Request $request)
    {
        
        $fpbt = fopen('coin-payment'.time().'.txt', 'w');
        fwrite($fpbt, json_encode($request->all(),true));
        fclose($fpbt);
    
    return true;
        FacadesSession::put('check_txn',$request->all());
       
        $blockinfo    = PaymentGateway::whereKeyword('coinPayment')->first();
        $blocksettings= $blockinfo->convertAutoData();
        $real_secret  = $blocksettings['secret_string'];
        $trans_id = $request->custom;
        $status = $request->status;
        $amount2 = floatval($request->amount2);
        $currency2 = $request->currency2;

        $getSec = Input::get('secret');
        if ($real_secret == $getSec){

            if (Order::where('order_number',$trans_id)->exists()){

                $order = Order::where('order_number',$trans_id)->where('payment_status','pending')->first();
                if ($status >= 100 || $status == 2) {
                    if ($currency2 == "BTC" && $order->coin_amount <= $amount2) {
                   
                            $order->payment_status = "completed";
                            $order->update();

                            $trans = new Transaction();
                            $trans->email = $order->customer_email;
                            $trans->amount = $order->invest;
                            $trans->type = "Invest";
                            $trans->txnid = $order->order_number;
                            $trans->user_id = $order->user_id;
                            $trans->save();

                        }
                    }

            }

        }
    }


    public function deposit(Request $request)
    {
        $generalsettings = Generalsetting::findOrFail(1);
        $blockinfo    = PaymentGateway::whereKeyword('coinPayment')->first();
        $blocksettings= $blockinfo->convertAutoData();

        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();
        if($order->invest > 0){

        $acc = $user;
        $item_number = $order->order_number;
        $item_amount = $order->invest;
        $currency_code = $order->currency_code;
      
        $secret = $blocksettings['secret_string'];
        $coin_public = $blocksettings['coin_public_key'];
        $coin_private = $blocksettings['coin_private_key'];

        $my_callback_url = url('/').'/user/api/invest/coinpay/notify?transx_id='.$item_number.'&secret='.$secret;

     
            $cps = new CoinPaymentsAPI();
            $cps->Setup($coin_private,$coin_public);

            $req = array(
                'amount' => 100,
                'currency1' => 'USD',
                'currency2' => 'LTCT',
                'buyer_email' => $acc->email,
                'item_name' => $generalsettings->title.' Invest.',
                'custom' => $item_number,
                'ipn_url' => $my_callback_url,
            );

            $result = $cps->CreateTransaction($req);
            if ($result['error'] == 'ok') {

                $qr_url = $result['result']['qrcode_url'];
                $sts_url = $result['result']['status_url'];
                $checkout_url = $result['result']['checkout_url'];

                $address = $result['result']['address'];

                $order->method = $request->method;

                $date = Carbon::now();
                $date = $date->addDays($request->days);
                $date = Carbon::parse($date)->format('Y-m-d h:i:s');
                $order['end_date'] = $date;
                $order->save();


                session([
                    'address' => $address,
                    'amount' => $result['result']['amount'],
                    'currency_value' => $item_amount,
                    'currency_sign' => $curr->sign,
                    'accountnumber' => $acc->id,
                    'status_url' => $sts_url,
                    'qrcode_url' => $qr_url,
                    'checkout_url' => $checkout_url
                ]);

                return redirect()->route('api.invest.coinpay.invest');

            } else {

                return redirect()->back()->with('unsuccess', $result['error'])->withInput();

            }

        }
        return redirect()->back()->with('unsuccess','Please enter a valid amount.')->withInput();
    }

}
