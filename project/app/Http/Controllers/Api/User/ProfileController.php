<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function update(Request $request){
        try {
            $rules = [
              'name' => 'required',
              'phone' => 'required',
              'fax' => 'required',
              'city' => 'required',
              'zip' => 'required',
              'address' => 'required',
              'photo' => 'mimes:jpeg,jpg,png,svg',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
              return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $user = Auth::guard('api')->user();
 
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->fax = $request->fax;
            $user->city = $request->city;
            $user->zip = $request->zip;
            $user->address = $request->address;

            if($file = $request->file('photo')){
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/',$name);
                @unlink('assets/images/'.$user->photo);
                $user->photo = $name;
            }
            $user->update();

            return response()->json(['status'=>true, 'data'=>new UserResource($user), 'error'=>[]]);

        } catch (\Exception $e) {
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function updatePassword(Request $request) {

        $rules =
        [
          'current_password' => 'required',
          'new_password' => 'required',
          'renew_password' => 'required',
        ];
 
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
 
        try{
            $user = Auth::guard('api')->user();

            if (Hash::check($request->current_password, $user->password)){
                if ($request->new_password == $request->renew_password){
                    $input['password'] = Hash::make($request->new_password);
                }else{
                    return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Confirm password does not match.']]);  
                }
            }else{
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Current password Does not match.']]);     
            }
            $user->update($input);
            return response()->json(['status' => true, 'data' => ['message' => 'Successfully changed your password.'], 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
