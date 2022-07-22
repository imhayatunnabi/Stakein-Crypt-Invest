<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawDetailsResource;
use App\Http\Resources\WithdrawResource;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function index()
    {
        try{
        $user = auth()->user();
        $withdraws = Withdraw::where('user_id','=',$user->id)->where('type','=','user')->orderBy('id','desc')->get();     
        return response()->json(['status' => true, 'data' => WithdrawResource::collection($withdraws), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
    
    
  	public function methods_field()
    {
        try{
            $methods = WithdrawMethod::all();
            return response()->json(['status' => true, 'data' => $methods, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => false, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }



    public function store(Request $request)
    {
        try{
            $rules = [
                'withdraw_method' => 'required',
                'amount' => 'required',
                'details' => 'required',
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

        $user = auth()->user();
        $from = User::findOrFail($user->id);

        $withdrawcharge = Generalsetting::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fee;

        if($request->amount > 0){

            $amount = $request->amount;
        
            if ($from->income >= $amount){
                $fee = (($withdrawcharge->withdraw_charge / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
        
                if($finalamount>0){
                    if ($from->income >= $finalamount){
                        $finalamount = number_format((float)$finalamount,2,'.','');
        
                        $from->income = $from->income - $amount;
                        $from->update();
        
                        $newwithdraw = new Withdraw();
                        $newwithdraw['user_id'] = Auth::guard('api')->id();
                        $newwithdraw['method'] = $request->withdraw_method;
        
                        $newwithdraw['amount'] = $finalamount;
                        $newwithdraw['fee'] = $fee;
                        $newwithdraw['details'] = $request->details;
                        $newwithdraw->save();
        
                        return response()->json(['status' => true, 'data' => new WithdrawResource($newwithdraw), 'error' => []]);
                    }else{
                        return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Insufficient Balance.']]); 
                    }
                }else{
                    return response()->json(array('errors' => [ 0 => 'Amount should be greater than this.Fee is' ]));
                    return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Amount should be greater than this.Fee is']]);
                }
        
            }else{
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Insufficient Balance.']]); 
        
            }
        }
        return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Please enter a valid amount.']]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }

    }
}


