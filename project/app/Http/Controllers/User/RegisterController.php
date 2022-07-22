<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        return view('user.register');
    }

    public function register(Request $request)
    {
        $value = session('captcha_string');
        if ($request->codes != $value){
            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
        }

        $rules = [
            'email'   => 'required|email|unique:users',
            'password' => 'required|confirmed'
            ];
        $validator = FacadesValidator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $gs = Generalsetting::findOrFail(1);
        $user = new User;
        $input = $request->all();        
        $input['password'] = bcrypt($request['password']);
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);
        $user->fill($input)->save();

        if($gs->is_verification_email == 1)
        {
            $to = $request->email;
            $subject = 'Verify your email address.';
            $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";

            if($gs->is_smtp == 1)
            {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }
        return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
        }
        else {

            if (Session::has('affilate')) 
            {
                $referral = User::findOrFail(Session::get('affilate'));
                $user->referral_id = $referral->id;
                $user->update();
            }

            if($gs->is_affilate == 1){
                if(Session::has('affilate')){

                    $mainUser = User::findOrFail(Session::get('affilate'));
                    $mainUser->income += $gs->affilate_user;
                    $mainUser->update();

                    $user->income += $gs->affilate_new_user;
                    $user->update();
                }
            }

            $user->email_verified = 'Yes';
            $user->update();
            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->save();
            Auth::guard('web')->login($user); 

            return response()->json(1);
        }

    }

    public function token($token)
    {
            $gs = Generalsetting::findOrFail(1);
            if($gs->is_verification_email == 1)
            {       
                $user = User::where('verification_link','=',$token)->first();
                if(isset($user))
                {
                    $user->email_verified = 'Yes';
                    $user->update();

                            if (Session::has('affilate')) 
                            {
                                $referral = User::findOrFail(Session::get('affilate'));
                                $user->referral_id = $referral->id;
                                $user->update();
                            }

                            if($gs->is_affilate == 1 && Session::has('affilate')){
                                $mainUser = $referral;
                                $mainUser->income += $gs->affilate_user;
                                $mainUser->update();
            
                                $user->income += $gs->affilate_new_user;
                                $user->update();
                            }


                    $notification = new Notification;
                    $notification->user_id = $user->id;
                    $notification->save();
                    Auth::guard('web')->login($user); 
                    return redirect()->route('user.dashboard')->with('success','Email Verified Successfully');
                }
            }
            else {
                return redirect()->back();  
            }
    }
}
