<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvestResource;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvestController extends Controller
{
    public function index(){
        try {
           $plans = Product::all();
           return response()->json(['status'=>true, 'data'=>InvestResource::collection($plans), 'error'=>[]]);
        } catch (\Exception $e) {
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function preInvest(Request $request,$id){
        try{
            $rules = [
                'amount' => 'required',
                'currency_code' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
              }

            $plan = Product::findOrFail($id);
            
            if($plan->min_price < $request->amount){
                return response()->json(['status' => false, 'data' => [], 'error' => ['message'=>'Amount Should be greater than minimum amount']]);
            }

            if($request->amount > $plan->max_price){
                return response()->json(['status' => false, 'data' => [], 'error' => ['message'=>'Amount should be less than maximum amount']]);
            }
            $order_number = Str::random(4).time();
            $user = Auth::guard('api')->user();
            $curr = Currency::where('name','=',$request->currency_code)->first();

            $investAmount = $request->amount/$curr->value;

            $order = new Order();
            $order->user_id = $user->id;
            $order->currency_sign = $curr->sign;
            $order->currency_code = $curr->name;
            $order->order_number = $order_number;
            $order->invest = $investAmount;
            $order->pay_amount = ($investAmount * $plan->percentage)/100;
            $order->payment_status = 'pending';
            $order->customer_email = $user ? $user->email : '';
            $order->customer_name = $user ? $user->name : '';
            $order->customer_phone = $user ? $user->phone : '';
            $order->customer_city = $user ? $user->city : '';
            $order->customer_zip = $user ? $user->zip : '';
            $order->title = $plan->title;
            $order->subtitle = $plan->subtitle;
            $order->details = $plan->details;
            $order->status = 'pending';


            $date = Carbon::now();
            $date = $date->addDays($plan->days);
            $date = Carbon::parse($date)->format('Y-m-d h:i:s');
            $order['end_date'] = $date;
            $order->save();

            return response()->json(['status' => true, 'data' =>route('user.invest.send',$order_number), 'error' => []]);
      

        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function checkout($id){
        try{
            $plan = Product::findOrFail($id);
            $currency = Currency::where('is_default',1)->first();
            if(Session::get('currency')){
                $currency = Currency::whereId(Session::get('currency'))->first();
            }else{
                $currency = Currency::where('is_default',1)->first();
            }

            $data['customer_name'] = auth()->user()->name;
            $data['customer_email'] = auth()->user()->email;
            $data['customer_phone'] = auth()->user()->phone;
            $data['customer_address'] = auth()->user()->address;
            $data['customer_city'] = auth()->user()->city;
            $data['customer_zip'] = auth()->user()->zip;
            $data['user_id'] = auth()->id();
            $data['plan_title'] = $plan->title;
            $data['plan_percentage'] = $plan->percentage;
            $data['plan_bonus_in_days'] = $plan->days;
            $data['plan_details'] = $plan->details;
            $data['currency_sign'] = $currency->sign;
            $data['currency_code'] = $currency->name;
            $data['currency_id'] = $currency->id;
            $data['amount'] = session('getprice');

            $order = new Order();

            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);

        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function sendInvest($number){
        $invest = Order::where('order_number',$number)->first();
        $gateways = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();
        $paystackGateway = PaymentGateway::where('keyword','paystack')->first();
        $paystackdata = $paystackGateway->convertAutoData();

        return view('user.order.payment',compact('invest','gateways','paystackdata'));
    }
}
