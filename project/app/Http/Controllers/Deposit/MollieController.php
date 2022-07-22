<?php

namespace App\Http\Controllers\Deposit;

use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use App\Models\Deposit;
use Carbon\Carbon;
use Session;
use Auth;
use Str;

class MollieController extends Controller
{
    public function store(Request $request){

        $input = $request->all();
        $item_amount = $request->amount;

        $item_name = "Deposit via Molly Payment";

      
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'USD',
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('deposit.molly.notify'),
            ]);

    
        Session::put('molly_data',$input);
        Session::put('payment_id',$payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }


    public function notify(Request $request){

        $input = Session::get('molly_data');
        $success_url = route('payment.return');
        $cancel_url = route('payment.cancle');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
      
        if($payment->status == 'paid'){

            $deposit = new Deposit();
            $deposit['deposit_number'] = Str::random(4).time();
            $deposit['user_id'] = auth()->user()->id;
            $deposit['amount'] = $input['amount'];
            $deposit['method'] = $input['method'];
            $deposit['status'] = "complete";
            $deposit['txnid'] = $payment->id;
            $deposit->save();


            $gs =  Generalsetting::findOrFail(1);
            $user = auth()->user();

            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'type' => "Deposti",
                    'cname' => $user->name,
                    'oamount' => $input['amount'],
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($data);            
            }
            else
            {
               $to = $user->email;
               $subject = " You have deposited successfully.";
               $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);            
            }
   
            Session::forget('molly_data');
            return redirect()->route('user.deposit.create')->with('success','Deposit amount ('.$input['amount'].') successfully!');
        }
        else {
            return redirect()->route('user.deposit.create')->with('unsuccess','Something Went wrong!');
        }

        return redirect()->route('user.deposit.create')->with('unsuccess','Something Went wrong!');
    }
}
