<?php

namespace App\Models;

use Carbon\Carbon;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
   protected $fillable = ['name', 'photo', 'zip', 'residency', 'city', 'address', 'phone', 'fax', 'email','password','verification_link','affilate_code','is_provider','twofa','go','details','is_kyc'];

    protected $hidden = [
        'password', 'remember_token'
    ];

	public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    
    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    public function withdraws()
    {
        return $this->hasMany('App\Models\Withdraw');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }
}
