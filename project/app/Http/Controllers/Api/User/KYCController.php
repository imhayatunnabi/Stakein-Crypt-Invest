<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KYCController extends Controller
{
    public function kyc(Request $request){
        try{
            $rules = [
                'details' => 'required'
            ];
    
            $validator = Validator::make($request->all(),$rules);
    
            if($validator->fails()){
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }
    
            $user = Auth::guard('api')->user();
            $user->details = $request->details;
            $user->update();
    
            return response()->json(['status'=>true, 'data'=> 'KYC submitted successfully.', 'error'=>[]]);
        }catch(\Exception $e){
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }

    }
}
