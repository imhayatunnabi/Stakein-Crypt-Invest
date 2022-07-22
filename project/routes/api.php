<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Front\FrontendController;
use App\Http\Controllers\Api\Payment\Deposit\PaypalController;
use App\Http\Controllers\Api\Payment\Deposit\StripeController;
use App\Http\Controllers\Api\User\DashboardController;
use App\Http\Controllers\Api\User\DepositController;
use App\Http\Controllers\Api\User\InvestController;
use App\Http\Controllers\Api\User\MessageController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\SendMoneyController;
use App\Http\Controllers\Api\User\WithdrawController;
use App\Http\Controllers\User\KYCController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user'], function () {
    Route::post('registration', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('forgot', [AuthController::class,'forgot']);
    Route::post('forgot/submit', 'Api\Auth\AuthController@forgot_submit');
    Route::post('social/login', 'Api\Auth\AuthController@social_login');
    Route::post('refresh/token', [AuthController::class,'refresh']);
    Route::get('details', [AuthController::class,'details']);

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('dashboard',[DashboardController::class,'index']);
        Route::get('ref',[DashboardController::class,'index']);
        Route::get('invest-history',[DashboardController::class,'investHistory']);
        Route::get('payout-history',[DashboardController::class,'payoutHistory']);
        Route::get('deposit-history',[DashboardController::class,'depositHistory']);
        Route::get('transactions',[DashboardController::class,'transactions']);

        Route::get('/invest/{id}',[InvestController::class,'checkout']);
        Route::post('/invest/{id}',[InvestController::class,'preInvest']);

        Route::get('/deposits', [DepositController::class,'deposits']);
        Route::get('/deposit/cancel', [DepositController::class,'cancel'])->name('api.deposit.deposit.cancel');
        Route::get('/available-deposit/gatways', [DepositController::class,'availableGateways']);
        Route::post('/deposit/store', [DepositController::class,'store']);

        Route::get('/withdraws', [WithdrawController::class,'index']);
        Route::get('/withdraw/methods/field', [WithdrawController::class,'methods_field']);
        Route::post('/withdraw/create', [WithdrawController::class,'store']);

        Route::post('/send-money/create', [SendMoneyController::class,'store']);

        Route::get('tickets',[MessageController::class,'index']);
        Route::post('ticket/store',[MessageController::class,'store']);
        Route::post('message/reply',[MessageController::class,'messageReply']);
        Route::get('ticket/conversation/{id}',[MessageController::class,'conversation']);

        Route::post('/kyc', [KYCController::class,'kyc']);

        Route::post('profile-update',[ProfileController::class,'update']);
        Route::post('password-update',[ProfileController::class,'updatePassword']);

        Route::get('invest-plans',[InvestController::class,'index']);
    });
});

Route::group(['prefix' => 'front'], function () {
    Route::get('blogs',[FrontendController::class,'blogs']);
    Route::get('services',[FrontendController::class,'services']);
    Route::get('languages',[FrontendController::class,'languages']);
    Route::get('currencies',[FrontendController::class,'currencies']);
});


Route::fallback(function () {
    return response()->json(['status' => false, 'data' => [], 'error' => ['message' => 'Not Found!']], 404);
});