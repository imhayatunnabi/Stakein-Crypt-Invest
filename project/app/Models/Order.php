<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['user_id', 'cart', 'method','shipping', 'pickup_location', 'totalQty', 'pay_amount', 'txnid', 'charge_id','notify_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip','shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip','coin_address','coin_amount','vouge_merchant','confirmations', 'order_note', 'status','income_add_status','check_data'];

    protected $dates = [
        'created_at',
        'updated_at',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
