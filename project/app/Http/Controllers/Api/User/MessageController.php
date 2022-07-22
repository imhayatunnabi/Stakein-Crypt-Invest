<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Models\AdminUserConversation;
use App\Models\AdminUserMessage;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index(){
        try{
            $user = Auth::guard('api')->user();
            $messages = AdminUserConversation::where('user_id','=',$user->id)->get();

            return response()->json(['status'=>true, 'data'=>MessageResource::collection($messages), 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function store(Request $request) {
        try{
          $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
  
        $user = Auth::guard('api')->user();     
        $gs = Generalsetting::find(1);
        $subject = $request->subject;
        $to = $gs->email;
        $from = $user->email;
        $msg = "Email: ".$from."\nMessage: ".$request->message;

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
  

        $conv = AdminUserConversation::where('user_id','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
  
          $msg = new AdminUserMessage();
          $msg->conversation_id = $conv->id;
          $msg->message = $request->message;
          $msg->user_id = $user->id;
          $msg->save(); 
          return response()->json(['status' => true, 'data' => new ConversationResource($msg), 'error' => []]); 
  
        }
        else{
          $message = new AdminUserConversation();
          $message->subject = $subject;
          $message->user_id= $user->id;
          $message->message = $request->message;
          $message->save();
  

          $msg = new AdminUserMessage();
          $msg->conversation_id = $message->id;
          $msg->message = $request->message;
          $msg->user_id = $user->id;
          $msg->save();
          return response()->json(['status' => true, 'data' => new MessageResource($message), 'error' => []]);
        }
  
  
        }
        catch(\Exception $e){
          return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
  
      }

      public function messageReply(Request $request)
      {
          try{
            $rules =
            [
              'user_id' => 'required',
              'message' => 'required',
              'conversation_id' => 'required'
            ];
     
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
             return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }
  
            $msg = new AdminUserMessage();
            $input = $request->all();
            $input['user_id'] = auth()->user()->id;
            $msg->fill($input)->save();

            //--- Redirect Section
  
            return response()->json(['status' => true, 'data' => new ConversationResource($msg), 'error' => []]);
            //--- Redirect Section Ends
          }
          catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
          }
      }

      public function conversation($id){
        try{
            $user = Auth::guard('api')->user();
            $messages = AdminUserMessage::where('conversation_id','=',$id)->get();

            return response()->json(['status'=>true, 'data'=>ConversationResource::collection($messages), 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
      }
}
