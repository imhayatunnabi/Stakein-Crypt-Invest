<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
use App\Classes\GeniusMailer;
use App\Models\Order;
use App\Models\User;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\UserNotification;

class InvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables($status)
    {
        if($status == 'pending'){
            $datas = Order::where('status','pending')->orderBy('id','desc');
        }
        elseif($status == 'running'){
            $datas = Order::where('status','running')->orderBy('id','desc');
        }
        elseif($status == 'processing') {
            $datas = Order::where('status','processing')->orderBy('id','desc');
        }
        elseif($status == 'completed') {
            $datas = Order::where('status','completed')->orderBy('id','desc');
        }
        elseif($status == 'declined') {
            $datas = Order::where('status','declined')->orderBy('id','desc');
        }
        else{
          $datas = Order::orderBy('id','desc');  
        }

         
        return Datatables::of($datas)
                            ->editColumn('customer_email', function(Order $data) {
                                return $data->customer_email;
                            })
                            ->editColumn('pay_amount', function(Order $data) {
                                $gs = Generalsetting::find(1);
                                return $gs->currency_sign.$data->pay_amount;
                            })
                            ->editColumn('invest', function(Order $data) {
                                $gs = Generalsetting::find(1);
                                return $gs->currency_sign.$data->invest;
                            })
                            ->editColumn('payment_status', function(Order $data) {
                                $status      = $data->payment_status == 'completed' ? _('Completed') : _('Not completed');
                                $status_sign = $data->payment_status == 'completed' ? 'success'   : 'danger';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invest.paymentstatus',['id1' => $data->id, 'status' => 'completed']).'">'.__("Completed").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invest.paymentstatus',['id1' => $data->id, 'status' => 'pending']).'">'.__("Not completed").'</a>
                                </div>
                              </div>';
                            })
                            ->editColumn('status', function(Order $data) {

                                if($data->status == 'pending'){
                                    $status = "Pending";
                                    $status_sign = $data->status == 'pending' ? 'warning' : '';
                                }elseif($data->status == 'running'){
                                    $status = "Running";
                                    $status_sign = $data->status == 'running' ? 'info' : '';
                                }elseif($data->status == 'declined'){
                                    $status = "Declined";
                                    $status_sign = $data->status == 'declined' ? 'danger' : '';
                                }else{
                                    $status = "Completed";
                                    $status_sign = $data->status == 'completed' ? 'success' : '';
                                }

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'status' => 'pending']).'">'.__("Pending").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'status' => 'running']).'">'.__("Running").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'status' => 'completed']).'">'.__("Completed").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.invests.status',['id1' => $data->id, 'status' => 'declined']).'">'.__("Declined").'</a>
                                </div>
                              </div>';
                            })
                            ->addColumn('action', function(Order $data) {
                                return '<div class="actions-btn"><a href="'.route('admin.invests.show',$data->id).'" class="btn btn-primary btn-sm btn-rounded"><i class="fas fa-eye"></i> '.__("View Details").'
                              </a></div>';
                            }) 
                            ->rawColumns(['id','customer_email','payment_status','status','action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.invest.index');
    }

    public function pending(){
        return view('admin.invest.pending');
    }

    public function running(){
        return view('admin.invest.running');
    }

    public function completed(){
        return view('admin.invest.completed');
    }

    public function declined(){
        return view('admin.invest.declined');
    }

    public function show($id){
        $data['order'] = Order::findOrFail($id);
        return view('admin.invest.details',$data);
    }

    public function status($id,$status)
    {
        $mainorder = Order::findOrFail($id);
        if ($mainorder->status == "completed"){
            $msg = 'This Invest is Already Completed';
            return response()->json($msg);       
        }else{
        if ($status == "completed"){

            $user = User::findOrFail($mainorder->user_id);
            
            if($user){
                $user->increment('income',$mainorder->pay_amount);
            }
            $stat['income_add_status'] = 1;

            $gs = Generalsetting::findOrFail(1);
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $mainorder->customer_email,
                    'subject' => 'Your invest '.$mainorder->order_number.' is Confirmed!',
                    'body' => "Hello ".$mainorder->customer_name.","."\n Thank you for investing with us. We are looking forward to your next visit.",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);                
            }
            else
            {
               $to = $mainorder->customer_email;
               $subject = 'Your invest '.$mainorder->order_number.' is Confirmed!';
               $msg = "Hello ".$mainorder->customer_name.","."\n Thank you for investing with us. We are looking forward to your next visit.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);                
            }
        }
        elseif ($status == "declined"){
            $gs = Generalsetting::findOrFail(1);
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $mainorder->customer_email,
                    'subject' => 'Your invest '.$mainorder->order_number.' is Declined!',
                    'body' => "Hello ".$mainorder->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                ];
                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else
            {
               $to = $mainorder->customer_email;
               $subject = 'Your invest '.$mainorder->order_number.' is Declined!';
               $msg = "Hello ".$mainorder->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);
            }

        }

        $stat['status'] = $status;
        $mainorder->update($stat);
              
        $msg = 'Invest Status Updated Successfully';
        return response()->json($msg);       
        }
    }

    public function paymentstatus ($id,$status)
    {
        $mainorder = Order::findOrFail($id);

        if ($mainorder->payment_status == "completed"){      
            $msg = 'This Payment is Already Completed';
            return response()->json($msg);      
        }else{
        if ($status == "completed"){

            $notification = new Notification();
            $notification->order_id = $mainorder->id;
            $notification->save();
    
            $trans = new Transaction();
            $trans->email = $mainorder->customer_email;
            $trans->amount = $mainorder->invest;
            $trans->type = "Invest";
            $trans->txnid = $mainorder->order_number;
            $trans->user_id = $mainorder->user_id;
            $trans->save();
    
            $notf = new UserNotification();
            $notf->user_id = $mainorder->user_id;
            $notf->order_id = $mainorder->id;
            $notf->type = "Invest";
            $notf->save();

            $gs = Generalsetting::findOrFail(1);
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $mainorder->customer_email,
                    'subject' => 'Your Payment '.$mainorder->order_number.' is Confirmed!',
                    'body' => "Hello ".$mainorder->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);                
            }
            else
            {
               $to = $mainorder->customer_email;
               $subject = 'Your Payment '.$mainorder->order_number.' is Confirmed!';
               $msg = "Hello ".$mainorder->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);                
            }

            if($gs->is_affilate == 1)
            {
                $user = User::find($mainorder->user_id);
                if ($user->referral_id != 0) 
                {
                    $val = $mainorder->invest / 100;
                    $sub = $val * $gs->affilate_charge;
                    $sub = round($sub,2);
                    $ref = User::find($user->referral_id);
                    if(isset($ref))
                    {
                        $ref->income += $sub;
                        $ref->update();
    
                        $trans = new Transaction;
                        $trans->email = $ref->email;
                        $trans->amount = $sub;
                        $trans->type = "Referral Bonus";
                        $trans->txnid = $mainorder->order_number;
                        $trans->user_id = $ref->id;
                        $trans->save();
                    }
                }
            }
        }

        $stat['payment_status'] = ucfirst($status);
        $mainorder->update($stat);
     
        $msg = 'Payment Status Updated Successfully';
        return response()->json($msg);      
 
        }
    }
}
