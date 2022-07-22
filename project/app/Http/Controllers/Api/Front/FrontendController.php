<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ServiceResource;
use App\Models\Blog;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function blogs(){
        try {
            $blogs = Blog::all();
            return response()->json(['status'=>true, 'data'=>BlogResource::collection($blogs), 'error'=>[]]);
        } catch (\Exception $e) {
            return response()->json(['status'=>true, 'data'=>[], 'error'=>[ 'message'=> $e->getMessage()]]);
        }
    }

    public function services(){
        try {
            $services = Service::all();
            return response()->json(['status'=>true, 'data'=>ServiceResource::collection($services), 'error'=>[]]);
        } catch (\Exception $e) {
            return response()->json(['status'=>true, 'data'=>[], 'error'=>['message'=>$e->getMessage()]]);
        }
    }

    public function currencies() {
        try{
          $currencies = Currency::all();
          return response()->json(['status' => true, 'data' => $currencies, 'error' => []]);
        }
        catch(\Exception $e){
          return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function languages() {
        try{
          $languages = Language::all();
          return response()->json(['status' => true, 'data' => $languages, 'error' => []]);
        }
        catch(\Exception $e){
          return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    
}
