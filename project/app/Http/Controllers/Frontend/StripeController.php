<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Input;
use Redirect;
use Stripe\Error\Card;
use URL;
use Validator;

class StripeController extends Controller
{
    public $orderRepositorty;
    public  $allusers = [];
    
    public function __construct(OrderRepository $orderRepositorty)
    {
        $stripe = Generalsetting::findOrFail(1);
        Config::set('services.stripe.key', $stripe->stripe_key);
        Config::set('services.stripe.secret', $stripe->stripe_secret);

        $this->orderRepositorty = $orderRepositorty;
    }


    public function store(Request $request){

        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Invest";
        $item_amount = $request->invest;
        $item_number = Str::random(4).time();

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error','Token Problem With Your Token.');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->currency_code,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $addionalData = ['item_number'=>$item_number,'txnid'=>$charge['balance_transaction'],'charge_id'=>$charge['id']];
                    $this->orderRepositorty->order($request,'complete',$addionalData);
  

                    return redirect()->route('front.payreturn');
                }
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
    }

 

}
