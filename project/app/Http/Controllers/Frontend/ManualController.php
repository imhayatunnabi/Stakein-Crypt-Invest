<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManualController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){
        $item_number = Str::random(4).time();

        $addionalData = ['item_number'=>$item_number,'txnid'=>$request->txn_id4];
        $this->orderRepositorty->order($request,'manual',$addionalData);

        return redirect()->route('front.payreturn');
    }
}
