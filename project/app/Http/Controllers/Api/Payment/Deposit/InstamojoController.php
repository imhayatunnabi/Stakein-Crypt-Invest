<?php

namespace App\Http\Controllers\Api\Payment\Deposit;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Classes\Instamojo;
use App\Models\PaymentGateway;

class InstamojoController extends Controller
{
    public function store(Request $request){

        if(!$request->has('deposit_number')){
             return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
        
        
        $deposit_number = $request->deposit_number;
        $order = Deposit::where('deposit_number',$deposit_number)->firstOrFail();
        $curr = Currency::where('name','=',$order->currency_code)->firstOrFail();
    
        if($curr->name != "INR")
        {
            return redirect()->back()->with('unsuccess','Please Select INR Currency For Instamojo.');
        }
    
        $input = $request->all();
    

        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Order";
        $user_email = User::findOrFail($order->user_id)->email;
        
        $item_amount = $order->amount * $curr->value;

        $cancel_url = route('user.deposit.send',$order->deposit_number);
        $notify_url = route('api.deposit.instamojo.notify');

        $data = PaymentGateway::whereKeyword('Instamojo')->first();
        $paydata = $data->convertAutoData();

        if($paydata['sandbox_check'] == 1){
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $item_name,
                "amount" => round($item_amount,2),
                "send_email" => true,
                "email" => $user_email,
                "redirect_url" => $notify_url
                ));
            
            $redirect_url = $response['longurl'];
            $order['instamojo_id'] = $response['id'];
            $order['method'] = $request->method;
            $order->update();
        
        
        
        
            return redirect($redirect_url);
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
        
    }
    
    
    
    
    public function notify(Request $request){
    
        $data = $request->all();

        $order = Deposit::where('instamojo_id','=',$data['payment_request_id'])->first();
        $cancel_url = route('user.deposit.send',$order->deposit_number);
     
    
        if (isset($order)) {
            $order['txnid'] = $data['payment_id'];
            $order['status'] = 'complete';
            $order->update();

            $user = auth()->user();
            $user->income += $order->amount;
            $user->save();
            return redirect()->route('user.deposit.send',$order->deposit_number)->with('success','Deposit amount successfully!');
        }
        return $cancel_url;
    }
}
