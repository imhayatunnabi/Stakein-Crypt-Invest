<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;

class Product extends Model
{

    protected $fillable = ['subtitle','title','details','min_price','max_price','days','percentage'];
    public $timestamps = false;

    public function interest()
    {
        $rate = round(($this->percentage / 100),2);
        return $rate;
    }

    public function setPrice($price,$currencyValue){
        return round($price * $currencyValue,2);
    }

}
