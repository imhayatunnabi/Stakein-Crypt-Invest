<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KYCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function kycform()
    {
        return view('user.kyc.index');
    }

    public function kyc(Request $request){
        $rules = [
            'details' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $user = auth()->user();
        $user->details = $request->details;
        $user->update();

        return response()->json('KYC submitted successfully.');
    }
}
