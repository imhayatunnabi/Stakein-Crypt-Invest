<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){
        $user = User::findOrFail($request->user_id);

        if($user->income < $request->invest)
        {
            return redirect()->back()->with('unsuccess','Your Wallet Balance Less then Invest Amount!');
        }

        $item_number = Str::random(4).time();
        $txnid = Str::random(4).time().Str::random(4);
        

        $addionalData = ['item_number'=>$item_number,'txnid'=>$txnid];
        $this->orderRepositorty->order($request,'complete',$addionalData);

        $user = Auth::user();
        $user->income =$user->income - $request->invest;
        $user->update();
        
        return redirect()->route('front.payreturn');
    }

}
