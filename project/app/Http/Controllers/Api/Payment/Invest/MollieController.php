<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function store(Request $request){
        $input = $request->all();
        $settings = Generalsetting::findOrFail(1);
     
        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();

        $item_amount = $order->invest;
        $input = $request->all();

        $item_name = "Deposit via Molly Payment";

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $order->currency_code,
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('api.invest.molly.notify'),
            ]);

        $order->mehod = $request->method;
        $order->update();

        Session::put('payment_id',$payment->id);
        Session::put('molly_data',$order->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }


    public function notify(Request $request){

        $input = Session::get('molly_data');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
      
        $order = Order::whereId(Session::get('molly_data'))->wherePaymentStatus('pending')->first();
        if($payment->status == 'paid')
        {
            $order->txnid = $payment->id;
            $order->payment_status = 'completed';

            $date = Carbon::now();
            $date = $date->addDays($order->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order->end_date = $date;
            $order->save();


            $trans = new Transaction();
            $trans->email = $order->customer_email;
            $trans->amount = $order->invest;
            $trans->type = "Invest";
            $trans->txnid = $order->order_number;
            $trans->user_id = $order->user_id;
            $trans->save();
      
            Session::forget('molly_data');
            return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');
        }
        else {
            return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');
        }

        return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');
    }
}
