<?php

namespace App\Http\Middleware;

use App\Models\Generalsetting;
use Illuminate\Support\Facades\Auth;
use Closure;

class KYC
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gs = Generalsetting::first();
        $user = auth()->user();
        if($gs->kyc && $user->is_kyc == 0){
            return redirect()->route('user.kyc.form')->with('unsuccess','Update Your KYC First and wait for verification!');
        }
        return $next($request);
    }
}
