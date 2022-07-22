<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/paytm-callback',
        '/razorpay-notify',
        '/flutter/notify',
        '/coingate/notify',
        '/user/deposit/paytm-callback',
        '/user/deposit/razorpay-notify',
        '/blockio/notify',
        '/user/deposit/flutter/notify*',
        '/user/api/deposit/paytm-callback',
        '/user/api/deposit/razorpay-callback',
        '/user/invest/flutter/notify*',
        '/user/api/invest/paytm-callback',
        '/user/api/invest/razorpay-callback',
        '/user/api/invest/flutter/notify*',
    ];
}
