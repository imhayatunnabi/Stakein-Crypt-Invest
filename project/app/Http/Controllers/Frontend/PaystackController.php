<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PaystackController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){
        if($request->currency_code != "NGN")
        {
            return redirect()->back()->with('unsuccess','Please Select NGN Currency For Paystack.');
        }
        $item_number = Str::random(4).time();


        $addionalData = ['item_number'=>$item_number,'txnid'=>$request->ref_id];
        $this->orderRepositorty->order($request,'complete',$addionalData);
        
        return redirect()->route('front.payreturn');
    }
}
