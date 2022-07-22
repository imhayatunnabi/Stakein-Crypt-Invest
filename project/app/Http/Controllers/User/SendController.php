<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;

class SendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('user.transfer.index');
    }

    public function store(Request $request){

        $request->validate([
            'email'=> 'required',
            'amount'=> 'required',
        ]);
        
        $user = auth()->user();
        if($request->email == $user->email){
            return back()->with('unsuccess','You can not send money yourself!!');
        }

        if($request->amount>0 && $user->income>0){
            if($user->income > $request->amount){

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

                    return back()->with('success','Money Send Successfully.');
                }else{
                    return back()->with('unsuccess','Send Account not found!!');
                }
            }else{
                return back()->with('unsuccess','Insufficient Balance.');
            }
        }else{
            return back()->with('unsuccess','Amount should be greater than 0!!');
        }
    }
}
