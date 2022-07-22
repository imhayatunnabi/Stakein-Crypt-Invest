<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkrillController extends Controller{

    public function store(Request $request)
    {
       
        $val['pay_to_email'] = trim("showravhasan715@gmail.com");
        $val['transaction_id'] = "4555";

        $val['return_url'] = "";
        $val['return_url_text'] = "Return 56565";
        $val['cancel_url'] = "";
        $val['status_url'] = "";
        $val['language'] = 'EN';
        $val['amount'] = 50;
        $val['currency'] = "USD";
        $val['detail1_description'] = "tEST";
        $val['detail1_text'] = "Pay To tEST";
        $val['logo_url'] = asset('assets/images/logoIcon/logo.png');

        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = 'https://www.moneybookers.com/app/payment.pl';
        
        dd(json_encode($send));
    }
}