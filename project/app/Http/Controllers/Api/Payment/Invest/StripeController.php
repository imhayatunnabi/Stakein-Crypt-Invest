<?php

namespace App\Http\Controllers\Api\Payment\Invest;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
     
        $order = Order::where('order_number',$request->order_number)->first();
        if($order->payment_status == 'completed'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Invest Allready Completed."]);
        }

        $user = User::findOrFail($order->user_id);

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
                    'amount' => $order->invest,
                    'description' => 'Invest',
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $order->method = $request->method;

                    $order->customer_email = $request->email;
                    $order->customer_name = $request->name;
                    $order->customer_phone = $request->phone;
                    $order->customer_city = $request->city;
                    $order->customer_zip = $request->zip;

                    $order->txnid = $charge['balance_transaction'];
                    $order->charge_id = $charge['id'];
                    $order->payment_status = "completed";

                    $order->update();


                    $trans = new Transaction();
                    $trans->email = $order->customer_email;
                    $trans->amount = $order->invest;
                    $trans->type = "Invest";
                    $trans->txnid = $order->order_number;
                    $trans->user_id = $order->user_id;
                    $trans->save();

                    return redirect()->route('user.invest.send',$order->order_number)->with('success','Invest successfully complete.');
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
