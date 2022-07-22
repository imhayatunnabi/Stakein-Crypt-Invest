<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManualController extends Controller
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

        $order->method = $request->method;
        $order->txnid = Str::random(4).time().Str::random(4);
        $order->update();

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
