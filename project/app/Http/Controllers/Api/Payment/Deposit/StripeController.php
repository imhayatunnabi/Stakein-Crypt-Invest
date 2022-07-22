<?php

namespace App\Http\Controllers\Api\Payment\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Error\Card;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Support\Facades\Config;
use Input;
use Redirect;
use URL;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public function __construct()
    {
        $stripe = Generalsetting::findOrFail(1);
        Config::set('services.stripe.key', $stripe->stripe_key);
        Config::set('services.stripe.secret', $stripe->stripe_secret);
    }

    public function store(Request $request){

        $input = $request->all();
        $settings = Generalsetting::findOrFail(1);
     
        $deposit = Deposit::where('deposit_number',$request->deposit_number)->first();
        $user = User::findOrFail($deposit->user_id);

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
                    'currency' => $deposit->currency_code,
                    'amount' => $deposit->amount,
                    'description' => 'Deposit',
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $deposit['method'] = $request->method;
                    $deposit['txnid'] = $charge['balance_transaction'];
                    $deposit['charge_id'] = $charge['id'];
                    $deposit['status'] = "complete";

                    $deposit->save();


                    $user = auth()->user();
                    $user->income += $order->amount;
                    $user->save();

                    return redirect()->back()->with('success','Deposit amount ('.$request->amount.') successfully!');
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
