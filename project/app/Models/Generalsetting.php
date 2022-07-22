<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    protected $fillable = ['logo', 'favicon' ,'loader','admin_loader', 'banner', 'title','header_email','header_phone', 'footer','copyright','colors','talkto','map_key','disqus','paypal_business','stripe_key','stripe_secret','currency_format','withdraw_fee','withdraw_charge','tax','shipping_cost','smtp_host','smtp_port','smtp_encryption','smtp_user','smtp_pass','from_email','from_name','order_title','order_text','service_subtitle','service_title','service_text','blockchain_check','coinpayment_check','service_image','is_currency','price_bigtitle','price_title','price_subtitle','price_text','subscribe_success','subscribe_error','error_title','error_text','error_photo','breadcumb_banner','currency_code','currency_sign','withdraw_fee','withdraw_charge','affilate_banner','affilate_charge','secret_string','blockchain_xpub','blockchain_api','gap_limit','coin_public_key', 'coin_private_key', 'blockio_api_btc', 'blockio_api_ltc', 'blockio_api_dgc', 'vouge_merchant', 'blockio_btc', 'blockio_ltc', 'blockio_dgc', 'vougepay','coingate_auth','coingate','footer_logo','paypal_client_id','paypal_client_secret','paypal_sandbox_check','paystack_check','paystack_key','paystack_email','flutter_check','flutter_public_key','flutter_secret','paytm_check','paytm_merchant','paytm_secret','paytm_website','paytm_industry','paytm_text','paytm_mode','withdraw_status','isWallet','affilate_new_user','affilate_user','pm_account','is_pm','cc_api_key','is_coin_base','balance_transfer','two_factor','kyc','menu'];

    public $timestamps = false;
    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if (file_exists(public_path().'/assets/images/'.$oldname)) {
                unlink(public_path().'/assets/images/'.$oldname);
            }
        }  
    }
}
