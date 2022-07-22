<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try{
            $user = Auth::guard('api')->user();
            $nowDate = Carbon::now();
            $gs = Generalsetting::first();
            
            $orders = Order::where('status','running')->where('user_id',auth()->user()->id)->where('income_add_status',0)->orderBy('id','desc')->get();
    
            foreach($orders as $key=>$val){
                $result = $nowDate->gt($val->end_date);
                if($result){
                    $user = User::findOrFail($val->user_id);
                    $user->increment('income',$val->pay_amount);
                    $val->update(['income_add_status'=>1,'status'=>'completed']);
                }
            }
            $data['investAmount'] = Order::where('user_id',auth()->user()->id)->where('payment_status','completed')->sum('invest');
            $user = User::where('referral_id',auth()->user()->id)->first();
            $data['transactions'] = Order::where('user_id',auth()->id())->orderBy('id','desc')->limit(5)->get();
            $data['user'] = Auth::guard('api')->user();
            $data['currency'] = ['currency_format' => $gs->currency_format, 'currency_sign'=>$gs->currency_sign];


            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }

    }

    public function investHistory(){
        try{
            $user = Auth::guard('api')->user();
            $data['invests'] = Order::where('user_id','=',$user->id)->where('payment_status','=','completed')->where('status','=','pending')->orderBy('id','desc')->get();

            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function payoutHistory(){
        try{
            $user = Auth::guard('api')->user();
            $data['payouts'] = Order::where('user_id','=',$user->id)->where('status','=','Completed')->orderBy('id','desc')->get();

            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function depositHistory(){
        try{
            $user = Auth::guard('api')->user();
            $data['deposits'] = Deposit::orderby('id','desc')->where('user_id',$user->id)->get();

            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function transactions(){
        try{
            $user = Auth::guard('api')->user();
            $data['transactions'] = Transaction::orderby('id','desc')->where('user_id',$user->id)->get();

            return response()->json(['status'=>true, 'data'=>$data, 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }
}
