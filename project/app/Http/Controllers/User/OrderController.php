<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orders()
    {
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id','=',$user->id)->where('payment_status','=','completed')->where('status','=','pending')->orderBy('id','desc')->get();
        return view('user.order.invests',compact('user','orders'));
    }


    public function payouts()
    {
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id','=',$user->id)->where('status','=','Completed')->orderBy('id','desc')->get();
        return view('user.order.payouts',compact('user','orders'));
    }

    public function order($id)
    {
        $user = Auth::guard('web')->user();
        $order = Order::findOrfail($id);
        return view('user.order.details',compact('user','order'));
    }

}