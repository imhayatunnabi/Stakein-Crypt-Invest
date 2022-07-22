<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepositResource;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function deposits(){
        try{
            $data = Deposit::orderby('id','desc')->where('user_id',auth()->user()->id)->get();
            return response()->json(['status'=>true, 'data'=> DepositResource::collection($data), 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }
    
    public function availableGateways(){
        try {
            $availableGatways = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal'];
           $gateways = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();


            foreach($gateways as $key=>$gateway){
                if(in_array($gateway->keyword,$availableGatways)){
                    $data[] = $gateway;
                }
            }
            return response()->json(['status'=>true, 'data'=> $data, 'error'=>[]]);
        } catch (\Exception $e) {
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function store(Request $request) {

        try{

        //--- Validation Section

        $rules = [
            'amount'    => 'required',
            'currency_code' => 'required',
    
        ];
        $customs = [
            'amount.required'   => 'Payment Amount is required.',
            'currency_code.required'   => 'Currency Field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customs);
            
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }     
       
        //--- Validation Section Ends

        $input = $request->all();  

        if(!Auth::guard('api')->check()){
            return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Unauthenticated.']]);
        }
        
      
        $curr = Currency::where('name','=',$request->currency_code)->first();
        
        
   
        $user = Auth::guard('api')->user();
        $settings = Generalsetting::findOrFail(1);
        $item_name = "Deposit via ".$request->method;
        $deposit_number = Str::random(4).time();
  
        $deposit = new Deposit();
        $deposit->user_id = $user->id;
        $deposit->currency_id = $curr->id;
        $deposit->currency_code = $curr->name;
        $deposit->amount = $request->amount / $curr->value;
        $deposit->method = $request->method;
        $deposit->txnid = $request->txnid;
        $deposit->status = 'pending';
        $deposit->deposit_number = $deposit_number;
        $deposit->save();
        
        return response()->json(['status' => true, 'data' =>route('user.deposit.send',$deposit_number), 'error' => []]);
        
         }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    function sendDeposit($number){
        $deposit = Deposit::where('deposit_number',$number)->first();
        $availableGatways = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal'];
        $gateways = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();

        if($deposit->status == 'complete'){
            return response()->json(['status'=>false,'data'=>[],'error'=>"Deposit Allready Added."]);
        }

        return view('user.deposit.payment',compact('deposit','availableGatways','gateways'));
    }
}
