<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SendMoneyController extends Controller
{
    public function store(Request $request){

        try{
            $request->validate([
                'email'=> 'required',
                'amount'=> 'required|min:0',
            ]);
            
            $user = auth()->user();
            if($request->email == $user->email){
                return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>'You can not send money yourself!!']]);
            }

            if($user->income<=0){
                return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>'Amount should be greater than 0!']]);
            }

            if($user->income < $request->amount){
                return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>'Insufficient Balance!']]);
            }
    

            if($receiver = User::where('email',$request->email)->first()){
                $transaction = new Transaction();
                $transaction->user_id = auth()->user()->id;
                $transaction->receiver_id = $user->id;
                $transaction->email = auth()->user()->email;
                $transaction->amount = $request->amount;
                $transaction->type = 'Send Money';
                $transaction->txnid	 = Str::random(4).time();
                $transaction->save();

                $transaction = new Transaction();
                $transaction->user_id = $receiver->id;
                $transaction->email = $receiver->email;
                $transaction->amount = $request->amount;
                $transaction->type = 'Received Money';
                $transaction->txnid	 = Str::random(4).time();
                $transaction->save();


                $receiver->increment('income',$request->amount);
                $user->decrement('income',$request->amount);

                return response()->json(['status'=>true, 'data'=> new TransactionResource($transaction), 'error'=>[]]);
            }else{
                return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>'Send Account not found!!']]);
            }

        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>[$e->getMessage()]]);
        }
    }
}