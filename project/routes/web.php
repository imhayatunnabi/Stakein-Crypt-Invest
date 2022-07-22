<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AuthorBadgeController;
use App\Http\Controllers\Admin\AuthorLevelController;
use App\Http\Controllers\Admin\AuthorTrendingController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositController as AppDepositController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FontController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoToolController;
use App\Http\Controllers\Admin\SocialSettingController;
use App\Http\Controllers\Admin\StaffController;

use App\Http\Controllers\Deposit\AuthorizeController;
use App\Http\Controllers\Deposit\InstamojoController;
use App\Http\Controllers\Deposit\MollieController;
use App\Http\Controllers\Deposit\PaypalController;
use App\Http\Controllers\Deposit\PaytmController;
use App\Http\Controllers\Deposit\RazorpayController;
use App\Http\Controllers\Deposit\StripeController;
use App\Http\Controllers\User\DepositController;

use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\Payment\Deposit\AuthorizeController as DepositAuthorizeController;
use App\Http\Controllers\Api\Payment\Deposit\FlutterwaveController as DepositFlutterwaveController;
use App\Http\Controllers\Api\Payment\Deposit\InstamojoController as DepositInstamojoController;
use App\Http\Controllers\Api\Payment\Deposit\MollieController as DepositMollieController;
use App\Http\Controllers\Api\Payment\Deposit\PaypalController as DepositPaypalController;
use App\Http\Controllers\Api\Payment\Deposit\PaytmController as DepositPaytmController;
use App\Http\Controllers\Api\Payment\Deposit\RazorpayController as DepositRazorpayController;
use App\Http\Controllers\Api\Payment\Deposit\StripeController as DepositStripeController;
use App\Http\Controllers\Api\Payment\Invest\AuthorizeController as InvestAuthorizeController;
use App\Http\Controllers\Api\Payment\Invest\BlockChainController;
use App\Http\Controllers\Api\Payment\Invest\BlockIOController;
use App\Http\Controllers\Api\Payment\Invest\CoinGateController;
use App\Http\Controllers\Api\Payment\Invest\CoinPaymentController;
use App\Http\Controllers\Api\Payment\Invest\FlutterwaveController as InvestFlutterwaveController;
use App\Http\Controllers\Api\Payment\Invest\InstamojoController as InvestInstamojoController;
use App\Http\Controllers\Api\Payment\Invest\ManualController;
use App\Http\Controllers\Api\Payment\Invest\MollieController as InvestMollieController;
use App\Http\Controllers\Api\Payment\Invest\PaypalController as InvestPaypalController;
use App\Http\Controllers\Api\Payment\Invest\PaytmController as InvestPaytmController;
use App\Http\Controllers\Api\Payment\Invest\RazorpayController as InvestRazorpayController;
use App\Http\Controllers\Api\Payment\Invest\StripeController as InvestStripeController;
use App\Http\Controllers\Api\Payment\Invest\WalletController;
use App\Http\Controllers\Api\Payment\Invest\ParisiBankController;
use App\Http\Controllers\Api\Payment\Invest\PaystackController as InvestPaystackController;
use App\Http\Controllers\Api\User\DepositController as UserDepositController;
use App\Http\Controllers\Api\User\InvestController;
use App\Http\Controllers\Deposit\FlutterwaveController;
use App\Http\Controllers\Deposit\PaystackController;
use App\Http\Controllers\User\DashboardController as AppDashboardController;
use App\Http\Controllers\User\KYCController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\ReferralController as AppReferralController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Middleware\KYC;
use App\Http\Middleware\Otp;
use App\Models\Childcategory;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function(){

//-----------------------------Clear Cache--------------------
Route::get('/cache/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->route('admin.dashboard')->with('cache','System Cache Has Been Removed.');
  })->name('admin.cache.clear');
//-----------------------------Clear cache end----------------

  Route::get('/login', [LoginController::class,'showLoginForm'])->name('admin.login');
  Route::post('/login', [LoginController::class,'login'])->name('admin.login.submit');
  Route::get('/forgot', [LoginController::class,'showForgotForm'])->name('admin.forgot');
  Route::post('/forgot-submit', [LoginController::class,'forgot'])->name('admin.forgot.submit');
  Route::get('/change-password/{token}', [LoginController::class,'showChangePassForm'])->name('admin.change.token');
  Route::post('/change-password', [LoginController::class,'changepass'])->name('admin.change.password');
  Route::get('/logout', [LoginController::class,'logout'])->name('admin.logout');

  Route::get('/profile', [DashboardController::class,'profile'])->name('admin.profile');
  Route::post('/profile/update', [DashboardController::class,'profileupdate'])->name('admin.profile.update');

  Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
  Route::get('/password', [DashboardController::class,'passwordreset'])->name('admin.password');
  Route::post('/password/update', [DashboardController::class,'changepass'])->name('admin.password.update');

  Route::group(['middleware'=>'permissions:Menu Builder'],function(){
    Route::get('/menu-builder', [GeneralSettingController::class,'menubuilder'])->name('admin.gs.menubuilder');
  });

  Route::group(['middleware'=>'permissions:Invests'],function(){
    Route::get('/pendingorders/datatables/{slug}', 'Admin\OrderController@pendingdatatables')->name('admin-pendingorder-datatables');
    Route::get('/invests/datatables/{slug}', 'Admin\InvestController@datatables')->name('admin.invests.datatables');
    Route::get('/invests', 'Admin\InvestController@index')->name('admin.invests.index');
    Route::get('/invests/pending', 'Admin\InvestController@pending')->name('admin.invests.pending');
    Route::get('/invests/running', 'Admin\InvestController@running')->name('admin.invests.running');
    Route::get('/invests/completed', 'Admin\InvestController@completed')->name('admin.invests.completed');
    Route::get('/invests/declined', 'Admin\InvestController@declined')->name('admin.invests.declined');
    Route::get('/invest/{id}/show', 'Admin\InvestController@show')->name('admin.invests.show');
    Route::get('/invests/{id1}/status/{status}', 'Admin\InvestController@status')->name('admin.invests.status');
    Route::get('/pending/invests/{id1}/status/{status}', 'Admin\InvestController@paymentstatus')->name('admin.invest.paymentstatus');
  });

  Route::group(['middleware'=>'permissions:Transactions'],function(){
    Route::get('/transactions/datatables', [TransactionController::class,'datatables'])->name('admin.transactions.datatables');
    Route::get('/transactions', [TransactionController::class,'index'])->name('admin.transactions.index');
  });

  Route::group(['middleware'=>'permissions:Deposits'],function(){
    Route::get('/deposits/datatables',[AppDepositController::class,'datatables'])->name('admin.deposits.datatables');
    Route::get('/deposits',[AppDepositController::class,'index'])->name('admin.deposits.index');
  });

  Route::group(['middleware'=>'permissions:Manage Plans'],function(){
    //------------------------------Plan PAGE----------------------
    Route::get('/plan/datatables', [PlanController::class,'datatables'])->name('admin.plan.datatables');
    Route::get('/plans', [PlanController::class,'index'])->name('admin.plan.index');
    Route::get('/plan/create', [PlanController::class,'create'])->name('admin.plan.create');
    Route::post('/plan/store', [PlanController::class,'store'])->name('admin.plan.store');
    Route::get('/plan/edit/{id}', [PlanController::class,'edit'])->name('admin.plan.edit');
    Route::post('/plan/update/{id}', [PlanController::class,'update'])->name('admin.plan.update');
    Route::get('/plan/delete/{id}', [PlanController::class,'destroy'])->name('admin.plan.delete');
    // ---------------------------Plan page end---------------------
  });

  Route::get('/referrals',[ReferralController::class,'index'])->name('admin.referral.index');
  Route::post('/referral-level',[ReferralController::class,'store'])->name('admin.referral.store');

  Route::group(['middleware'=>'permissions:Manage Customers'],function(){
    Route::get('/users/bonus', 'Admin\BonusController@index')->name('admin.user.bonus');
    Route::post('/users/edit/', 'Admin\BonusController@update')->name('admin.bonus.update');
    Route::get('/users/datatables', 'Admin\UserController@datatables')->name('admin-user-datatables'); //JSON REQUEST
    Route::get('/users', 'Admin\UserController@index')->name('admin.user.index');
    Route::get('/users/withdraws', 'Admin\UserController@withdraws')->name('admin.withdraw.index');
    Route::get('/users/withdraws/datatables', 'Admin\UserController@withdrawdatatables')->name('admin.withdraw.datatables');
    Route::get('/users/withdraw/{id}/show', 'Admin\UserController@withdrawdetails')->name('admin.withdraw.show');
    Route::get('/users/withdraws/accept/{id}', 'Admin\UserController@accept')->name('admin-withdraw-accept');
    Route::get('/users/withdraws/reject/{id}', 'Admin\UserController@reject')->name('admin-withdraw-reject');
    Route::get('/users/edit/{id}', 'Admin\UserController@edit')->name('admin-user-edit');
    Route::post('/users/edit/{id}', 'Admin\UserController@update')->name('admin-user-update');
    Route::get('/users/delete/{id}', 'Admin\UserController@destroy')->name('admin-user-delete');
    Route::get('/user/{id}/show', 'Admin\UserController@show')->name('admin-user-show');
    Route::get('/users/ban/{id1}/{id2}', 'Admin\UserController@ban')->name('admin-user-ban');
    Route::get('/users/kyc/{id1}/{id2}', 'Admin\UserController@kyc')->name('admin-user-kyc');
    Route::get('/user/default/image', 'Admin\UserController@image')->name('admin-user-image');
    Route::get('/users/deposit/{id}', 'Admin\UserController@deposit')->name('admin-user-deposit');
    Route::post('/user/deposit/{id}', 'Admin\UserController@depositUpdate')->name('admin-user-deposit-update');


    Route::get('/withdraw-method/datatables', 'Admin\WithdrawMethodController@datatables')->name('admin-withdraw-method-datatables'); //JSON REQUEST
    Route::get('/withdraw-method', 'Admin\WithdrawMethodController@index')->name('admin-withdraw-method-index');
    Route::get('/withdraw-method/create', 'Admin\WithdrawMethodController@create')->name('admin-withdraw-method-create');
    Route::post('/withdraw-method/store', 'Admin\WithdrawMethodController@store')->name('admin-withdraw-method-store');
    Route::get('/withdraw-method/edit/{id}', 'Admin\WithdrawMethodController@edit')->name('admin-withdraw-method-edit');
    Route::post('/withdraw-method/update/{id}', 'Admin\WithdrawMethodController@update')->name('admin-withdraw-method-update');
    Route::get('/withdraw-method/delete/{id}', 'Admin\WithdrawMethodController@destroy')->name('admin-withdraw-method-delete');
  });

  Route::group(['middleware'=>'permissions:Manage Blog'],function(){
    //------------ ADMIN BLOG SECTION ------------
    Route::get('/blog/datatables', [BlogController::class,'datatables'])->name('admin.blog.datatables'); //JSON REQUEST
    Route::get('/blog', [BlogController::class,'index'])->name('admin.blog.index');
    Route::get('/blog/create', [BlogController::class,'create'])->name('admin.blog.create');
    Route::post('/blog/create', [BlogController::class,'store'])->name('admin.blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class,'edit'])->name('admin.blog.edit');
    Route::post('/blog/edit/{id}', [BlogController::class,'update'])->name('admin.blog.update');
    Route::get('/blog/delete/{id}', [BlogController::class,'destroy'])->name('admin.blog.delete');

    Route::get('/blog/category/datatables', [BlogCategoryController::class,'datatables'])->name('admin.cblog.datatables'); //JSON REQUEST
    Route::get('/blog/category', [BlogCategoryController::class,'index'])->name('admin.cblog.index');
    Route::get('/blog/category/create', [BlogCategoryController::class,'create'])->name('admin.cblog.create');
    Route::post('/blog/category/create', [BlogCategoryController::class,'store'])->name('admin.cblog.store');
    Route::get('/blog/category/edit/{id}', [BlogCategoryController::class,'edit'])->name('admin.cblog.edit');
    Route::post('/blog/category/edit/{id}', [BlogCategoryController::class,'update'])->name('admin.cblog.update');
    Route::get('/blog/category/delete/{id}', [BlogCategoryController::class,'destroy'])->name('admin.cblog.delete');
    //------------ ADMIN BLOG SECTION ENDS ------------
  });


  Route::group(['middleware'=>'permissions:General Setting'],function(){
    //------------ ADMIN GENERAL SETTINGS SECTION ------------
    Route::get('/general-settings/logo', [GeneralSettingController::class,'logo'])->name('admin.gs.logo');
    Route::get('/general-settings/favicon', [GeneralSettingController::class,'fav'])->name('admin.gs.fav');
    Route::get('/general-settings/loader', [GeneralSettingController::class,'load'])->name('admin.gs.load');
    Route::post('/general-settings/update/all', [GeneralSettingController::class,'generalupdate'])->name('admin.gs.update');
    Route::get('/general-settings/contents', [GeneralSettingController::class,'contents'])->name('admin.gs.contents');
    Route::get('/general-settings/theme', [GeneralSettingController::class,'theme'])->name('admin.gs.theme');

    Route::get('/general-settings/breadcumb', [GeneralSettingController::class,'breadcumb'])->name('admin.gs.breadcumb');
    Route::get('/general-settings/status/{field}/{status}', [GeneralSettingController::class,'status'])->name('admin.gs.status');
    Route::get('/general-settings/footer', [GeneralSettingController::class,'footer'])->name('admin.gs.footer');
    Route::get('/general-settings/affilate', [GeneralSettingController::class,'affilate'])->name('admin.gs.affilate');
    Route::get('/general-settings/error-banner', [GeneralSettingController::class,'errorbanner'])->name('admin.gs.error.banner');
    Route::get('/general-settings/popup', [GeneralSettingController::class,'popup'])->name('admin.gs.popup');
    Route::get('/general-settings/maintenance', [GeneralSettingController::class,'maintain'])->name('admin.gs.maintenance');
    //------------ ADMIN GENERAL SETTINGS JSON SECTION ENDS------------
  });

  Route::group(['middleware'=>'permissions:Homepage Setting'],function(){
      //------------ ADMIN SLIDEER SECTION ------------
      Route::get('/slider/datatables', [SliderController::class,'datatables'])->name('admin.slider.datatables'); //JSON REQUEST
      Route::get('/slider', [SliderController::class,'index'])->name('admin.slider.index');
      Route::get('/slider/create', [SliderController::class,'create'])->name('admin.slider.create');
      Route::post('/slider/create', [SliderController::class,'store'])->name('admin.slider.store');
      Route::get('/slider/edit/{id}', [SliderController::class,'edit'])->name('admin.slider.edit');
      Route::post('/slider/update/{id}', [SliderController::class,'update'])->name('admin.slider.update');
      Route::get('/slider/delete/{id}', [SliderController::class,'destroy'])->name('admin.slider.delete');
      //------------ ADMIN SLIDEER SECTION ENDS ------------

      //------------ ADMIN FEATURE SECTION ------------
      Route::get('/feature/datatables', [FeatureController::class,'datatables'])->name('admin.feature.datatables'); //JSON REQUEST
      Route::get('/feature', [FeatureController::class,'index'])->name('admin.feature.index');
      Route::get('/feature/create', [FeatureController::class,'create'])->name('admin.feature.create');
      Route::post('/feature/create', [FeatureController::class,'store'])->name('admin.feature.store');
      Route::get('/feature/edit/{id}', [FeatureController::class,'edit'])->name('admin.feature.edit');
      Route::post('/feature/update/{id}', [FeatureController::class,'update'])->name('admin.feature.update');
      Route::get('/feature/delete/{id}', [FeatureController::class,'destroy'])->name('admin.feature.delete');
      //------------ ADMIN FEATURE SECTION ENDS ------------

      //------------ ADMIN SERVICE SECTION ------------
      Route::get('/service/datatables', [ServiceController::class,'datatables'])->name('admin.service.datatables'); //JSON REQUEST
      Route::get('/service', [ServiceController::class,'index'])->name('admin.service.index');
      Route::get('/service/create', [ServiceController::class,'create'])->name('admin.service.create');
      Route::post('/service/store', [ServiceController::class,'store'])->name('admin.service.store');
      Route::get('/service/edit/{id}', [ServiceController::class,'edit'])->name('admin.service.edit');
      Route::post('/service/edit/{id}', [ServiceController::class,'update'])->name('admin.service.update');
      Route::get('/service/delete/{id}', [ServiceController::class,'destroy'])->name('admin.service.delete');
      //------------ ADMIN SERVICE SECTION ENDS ------------

      //------------ ADMIN MENU PAGE SETTINGS SECTION ------------
      Route::get('/page-settings/about', [PageSettingController::class,'about'])->name('admin.ps.about');
      Route::get('/page-settings/top/service', [PageSettingController::class,'topservice'])->name('admin.ps.topservice');
      Route::get('/page-settings/top/footer', [PageSettingController::class,'footertop'])->name('admin.ps.footertop');
      Route::post('/page-settings/contact/update', [PageSettingController::class,'contactupdate'])->name('admin.ps.contactupdate');
      Route::post('/page-settings/update/all', [PageSettingController::class,'update'])->name('admin.ps.update');
      //------------ ADMIN PAGE SECTION ------------

  });

  Route::group(['middleware'=>'permissions:Email Setting'],function(){
    //------------ ADMIN EMAIL SETTINGS SECTION ------------
    Route::get('/email-templates/datatables', [EmailController::class,'datatables'])->name('admin.mail.datatables');
    Route::get('/email-templates', [EmailController::class,'index'])->name('admin.mail.index');
    Route::get('/email-templates/{id}', [EmailController::class,'edit'])->name('admin.mail.edit');
    Route::post('/email-templates/{id}', [EmailController::class,'update'])->name('admin.mail.update');
    Route::get('/email-config', [EmailController::class,'config'])->name('admin.mail.config');
    Route::get('/groupemail', [EmailController::class,'groupemail'])->name('admin.group.show');
    Route::post('/groupemailpost', [EmailController::class,'groupemailpost'])->name('admin.group.submit');
    //------------ ADMIN EMAIL SETTINGS SECTION ENDS ------------
  });

  Route::group(['middleware'=>'permissions:Message'],function(){
    Route::post('/send/message', 'Admin\MessageController@usercontact')->name('admin.send.message');
    Route::get('/user/ticket','Admin\MessageController@index')->name('admin.user.message');
    Route::get('/messages/datatables/', 'Admin\MessageController@datatables')->name('admin.message.datatables');
    Route::get('/message/{id}', 'Admin\MessageController@message')->name('admin.message.show');
    Route::get('/message/{id}/delete', 'Admin\MessageController@messagedelete')->name('admin.message.delete');
    Route::post('/message/post', 'Admin\MessageController@postmessage')->name('admin.message.store');
    Route::get('/message/load/{id}', 'Admin\MessageController@messageshow')->name('admin-message-load');
  //------------ ADMIN USER SECTION ENDS ------------
  });

  Route::group(['middleware'=>'permissions:Payment Setting'],function(){
    //-----------------------------Paymentys Information----------------------------
    Route::post('/general-settings/update/all',[ GeneralSettingController::class,'generalupdate'])->name('admin.gs.update');
    Route::get('/payment/information', [PaymentGatewayController::class,'paymentinfo'])->name('admin.payment.info');
    Route::get('/paymentgateway/datatables', [PaymentGatewayController::class,'datatables'])->name('admin.payment.datatables'); //JSON REQUEST
    Route::get('/paymentgateway', [PaymentGatewayController::class,'index'])->name('admin.payment.index');
    Route::get('/paymentgateway/create', [PaymentGatewayController::class,'create'])->name('admin.payment.create');
    Route::post('/paymentgateway/create', [PaymentGatewayController::class,'store'])->name('admin.payment.store');
    Route::get('/paymentgateway/edit/{id}', [PaymentGatewayController::class,'edit'])->name('admin.payment.edit');
    Route::post('/paymentgateway/update/{id}', [PaymentGatewayController::class,'update'])->name('admin.payment.update');
    Route::delete('/paymentgateway/delete/{id}', [PaymentGatewayController::class,'destroy'])->name('admin.payment.delete');
    Route::get('/paymentgateway/status/{id1}/{id2}', [PaymentGatewayController::class,'status'])->name('admin.payment.status');



    Route::get('/general-settings/currency/{status}', [GeneralSettingController::class,'currency'])->name('admin.gs.iscurrency');
    Route::get('/currency/datatables', [CurrencyController::class,'datatables'])->name('admin.currency.datatables'); //JSON REQUEST
    Route::get('/currency',[ CurrencyController::class,'index'])->name('admin.currency.index');
    Route::get('/currency/create', [CurrencyController::class,'create'])->name('admin.currency.create');
    Route::post('/currency/create', [CurrencyController::class,'store'])->name('admin.currency.store');
    Route::get('/currency/edit/{id}', [CurrencyController::class,'edit'])->name('admin.currency.edit');
    Route::post('/currency/update/{id}', [CurrencyController::class,'update'])->name('admin.currency.update');
    Route::get('/currency/delete/{id}', [CurrencyController::class,'destroy'])->name('admin.currency.delete');
    Route::get('/currency/status/{id1}/{id2}', [CurrencyController::class,'status'])->name('admin.currency.status');
    //-----------------------------Payment Informations End-------------------------
  });

  Route::group(['middleware'=>'permissions:Manage Roles'],function(){
    // ------------ ROLE SECTION ----------------------
    Route::get('/role/datatables', [RoleController::class,'datatables'])->name('admin.role.datatables');
    Route::get('/role', [RoleController::class,'index'])->name('admin.role.index');
    Route::get('/role/create', [RoleController::class,'create'])->name('admin.role.create');
    Route::post('/role/create', [RoleController::class,'store'])->name('admin.role.store');
    Route::get('/role/edit/{id}', [RoleController::class,'edit'])->name('admin.role.edit');
    Route::post('/role/edit/{id}', [RoleController::class,'update'])->name('admin.role.update');
    Route::get('/role/delete/{id}', [RoleController::class,'destroy'])->name('admin.role.delete');
    // ------------ ROLE SECTION ENDS ----------------------
  });

  Route::group(['middleware'=>'permissions:Manage Staff'],function(){
    //------------ ADMIN STAFF SECTION ------------
    Route::get('/staff/datatables', [StaffController::class,'datatables'])->name('admin.staff.datatables');
    Route::get('/staff', [StaffController::class,'index'])->name('admin.staff.index');
    Route::get('/staff/create', [StaffController::class,'create'])->name('admin.staff.create');
    Route::post('/staff/create', [StaffController::class,'store'])->name('admin.staff.store');
    Route::get('/staff/edit/{id}', [StaffController::class,'edit'])->name('admin.staff.edit');
    Route::post('/staff/update/{id}', [StaffController::class,'update'])->name('admin.staff.update');
    Route::get('/staff/delete/{id}', [StaffController::class,'destroy'])->name('admin.staff.delete');
    //------------ ADMIN STAFF SECTION ENDS------------
  });

  Route::group(['middleware'=>'permissions:Language Setting'],function(){

    Route::get('/general-settings/language/{status}',[ GeneralSettingController::class,'language'])->name('admin.gs.islanguage');


    Route::get('/languages/datatables', [LanguageController::class,'datatables'])->name('admin.lang.datatables');
    Route::get('/languages', [LanguageController::class,'index'])->name('admin.lang.index');
    Route::get('/languages/create', [LanguageController::class,'create'])->name('admin.lang.create');
    Route::get('/languages/edit/{id}', [LanguageController::class,'edit'])->name('admin.lang.edit');
    Route::post('/languages/create', [LanguageController::class,'store'])->name('admin.lang.store');
    Route::post('/languages/edit/{id}', [LanguageController::class,'update'])->name('admin.lang.update');
    Route::get('/languages/status/{id1}/{id2}', [LanguageController::class,'status'])->name('admin.lang.st');
    Route::get('/languages/delete/{id}',[ LanguageController::class,'destroy'])->name('admin.lang.delete');


    //------------ ADMIN PANEL LANGUAGE SETTINGS SECTION ------------
    Route::get('/adminlanguages/datatables', [AdminLanguageController::class,'datatables'])->name('admin.tlang.datatables');
    Route::get('/adminlanguages', [AdminLanguageController::class,'index'])->name('admin.tlang.index');
    Route::get('/adminlanguages/create', [AdminLanguageController::class,'create'])->name('admin.tlang.create');
    Route::get('/adminlanguages/edit/{id}', [AdminLanguageController::class,'edit'])->name('admin.tlang.edit');
    Route::post('/adminlanguages/create', [AdminLanguageController::class,'store'])->name('admin.tlang.store');
    Route::post('/adminlanguages/edit/{id}', [AdminLanguageController::class,'update'])->name('admin.tlang.update');
    Route::get('/adminlanguages/status/{id1}/{id2}', [AdminLanguageController::class,'status'])->name('admin.tlang.st');
    Route::get('/adminlanguages/delete/{id}', [AdminLanguageController::class,'destroy'])->name('admin.tlang.delete');
    //------------ ADMIN PANEL LANGUAGE SETTINGS SECTION ENDS ------------

  });

  Route::group(['middleware'=>'permissions:Fonts'],function(){
    //------------ ADMIN FONT SECTION ------------
    Route::get('/fonts/datatables', [FontController::class,'datatables'])->name('admin.font.datatables');
    Route::get('/fonts', [FontController::class,'index'])->name('admin.font.index');
    Route::get('/font/create', [FontController::class,'create'])->name('admin.font.create');
    Route::post('/font/store', [FontController::class,'store'])->name('admin.font.store');
    Route::get('/font/edit/{id}', [FontController::class,'edit'])->name('admin.font.edit');
    Route::post('/font/update/{id}', [FontController::class,'update'])->name('admin.font.update');
    Route::get('/font/status/{id1}/{id2}', [FontController::class,'status'])->name('admin.font.status');
    Route::get('/font/delete/{id}', [FontController::class,'destroy'])->name('admin.font.delete');
    //------------ ADMIN FONT SECTION ENDS------------
  });

  Route::group(['middleware'=>'permissions:Menupage Setting'],function(){
    Route::get('/page-settings/contact', [PageSettingController::class,'contact'])->name('admin.ps.contact');


    Route::get('/page/datatables', [PageController::class,'datatables'])->name('admin.page.datatables'); //JSON REQUEST
    Route::get('/page', [PageController::class,'index'])->name('admin.page.index');
    Route::get('/page/create', [PageController::class,'create'])->name('admin.page.create');
    Route::post('/page/create', [PageController::class,'store'])->name('admin.page.store');
    Route::get('/page/edit/{id}', [PageController::class,'edit'])->name('admin.page.edit');
    Route::post('/page/update/{id}', [PageController::class,'update'])->name('admin.page.update');
    Route::get('/page/delete/{id}', [PageController::class,'destroy'])->name('admin.page.delete');
    Route::get('/page/status/{id1}/{id2}', [PageController::class,'status'])->name('admin.page.status');


    //------------------------------FAQ PAGE----------------------
    Route::get('/faq/datatables', [FaqController::class,'datatables'])->name('admin.faq.datatables');
    Route::get('/admin-faq', [FaqController::class,'index'])->name('admin.faq.index');
    Route::get('/faq/create', [FaqController::class,'create'])->name('admin.faq.create');
    Route::get('/faq/edit/{id}', [FaqController::class,'edit'])->name('admin.faq.edit');
    Route::get('/faq/delete/{id}', [FaqController::class,'destroy'])->name('admin.faq.delete');
    Route::post('/faq/update/{id}', [FaqController::class,'update'])->name('admin.faq.update');
    Route::post('/faq/create', [FaqController::class,'store'])->name('admin.faq.store');
    // ---------------------------Faq page end---------------------
  });

  Route::group(['middleware'=>'permissions:Seo Tools'],function(){
    //------------ ADMIN SEOTOOL SETTINGS SECTION ------------
    Route::get('/seotools/analytics', [SeoToolController::class,'analytics'])->name('admin.seotool.analytics');
    Route::post('/seotools/analytics/update', [SeoToolController::class,'analyticsupdate'])->name('admin.seotool.analytics.update');
    Route::get('/seotools/keywords', [SeoToolController::class,'keywords'])->name('admin.seotool.keywords');
    Route::post('/seotools/keywords/update', [SeoToolController::class,'keywordsupdate'])->name('admin.seotool.keywords.update');
    Route::get('/products/popular/{id}',[SeoToolController::class,'popular'])->name('admin.prod.popular');
    //------------ ADMIN SEOTOOL SETTINGS SECTION ------------
  });

  Route::group(['middleware'=>'permissions:Sitemaps'],function(){
    //------------Sitemap Section---------------------
    Route::get('/sitemap/datatables', [SitemapController::class,'datatables'])->name('admin.sitemap.datatables');
    Route::get('/sitemap',[SitemapController::class,'index'])->name('admin.sitemap.index');
    Route::get('/sitemap/create',[SitemapController::class,'create'])->name('admin.sitemap.create');
    Route::post('/sitemap/store', [SitemapController::class,'store'])->name('admin.sitemap.store');
    Route::get('/sitemap/{id}/update',[SitemapController::class,'update'])->name('admin.sitemap.update');
    Route::get('/sitemap/{id}/delete', [SitemapController::class,'delete'])->name('admin.sitemap.delete');
    Route::post('/sitemap/download', [SitemapController::class,'download'])->name('admin.sitemap.download');
    //------------Sitemap Section End---------------------
  });

  Route::group(['middleware'=>'permissions:Subscribers'],function(){
    //------------ ADMIN SUBSCRIBERS SECTION ------------
    Route::get('/subscribers/datatables', [SubscriberController::class,'datatables'])->name('admin.subs.datatables'); //JSON REQUEST
    Route::get('/subscribers', [SubscriberController::class,'index'])->name('admin.subs.index');
    Route::get('/subscribers/download', [SubscriberController::class,'download'])->name('admin.subs.download');
    //------------ ADMIN SUBSCRIBERS ENDS --------------
  });

  Route::group(['middleware'=>'permissions:Social Setting'],function(){
    //------------ ADMIN SOCIAL SETTINGS SECTION ------------
    Route::get('/social', [SocialSettingController::class,'index'])->name('admin.social.index');
    Route::post('/social/update', [SocialSettingController::class,'socialupdate'])->name('admin.social.update');
    Route::post('/social/update/all', [SocialSettingController::class,'socialupdateall'])->name('admin.social.update.all');
    Route::get('/social/facebook', [SocialSettingController::class,'facebook'])->name('admin.social.facebook');
    Route::get('/social/google', [SocialSettingController::class,'google'])->name('admin.social.google');
    Route::get('/social/facebook/{status}', [SocialSettingController::class,'facebookup'])->name('admin.social.facebookup');
    Route::get('/social/google/{status}', [SocialSettingController::class,'googleup'])->name('admin.social.googleup');
    //------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------
  });

    Route::get('/check/movescript', 'Admin\DashboardController@movescript')->name('admin-move-script');
    Route::get('/generate/backup', 'Admin\DashboardController@generate_bkup')->name('admin-generate-backup');
    Route::get('/activation', 'Admin\DashboardController@activation')->name('admin-activation-form');
    Route::post('/activation', 'Admin\DashboardController@activation_submit')->name('admin-activate-purchase');
    Route::get('/clear/backup', 'Admin\DashboardController@clear_bkup')->name('admin-clear-backup');

});

Route::prefix('user')->group(function() {

  Route::get('/login', [UserLoginController::class,'showLoginForm'])->name('user.login');
  Route::post('/login', [UserLoginController::class,'login'])->name('user.login.submit');

  Route::get('/otp', [OTPController::class,'showotpForm'])->name('user.otp');
  Route::post('/otp', [OTPController::class,'otp'])->name('user.otp.submit');

  Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('user.register');
  Route::post('/register', [RegisterController::class,'register'])->name('user.register.submit');
  Route::get('/register/verify/{token}', [RegisterController::class,'token'])->name('user.register.token');

  Route::middleware([Otp::class])->group(function () {

    Route::get('/dashboard', 'User\UserController@index')->name('user.dashboard');
    Route::get('/transactions', 'User\UserController@trans')->name('user-trans');
    Route::get('/rank','User\UserController@ranks')->name('user-ranks');
    Route::get('/two-factor', 'User\UserController@showTwoFactorForm')->name('user-show2faForm');
    Route::post('/createTwoFactor', 'User\UserController@createTwoFactor')->name('user-createTwoFactor');
    Route::post('/disableTwoFactor', 'User\UserController@disableTwoFactor')->name('user-disableTwoFactor');

    Route::get('/profile', 'User\UserController@profile')->name('user-profile');
    Route::post('/profile', 'User\UserController@profileupdate')->name('user-profile-update');

    Route::get('/forgot', 'User\ForgotController@showforgotform')->name('user-forgot');
    Route::post('/forgot', 'User\ForgotController@forgot')->name('user-forgot-submit');

    Route::get('/kyc-form', [KYCController::class,'kycform'])->name('user.kyc.form');
    Route::post('/kyc-form', [KYCController::class,'kyc'])->name('user.kyc.submit');

    Route::get('/referrals',[AppReferralController::class,'referred'])->name('user.referral.index');
    Route::get('/referral-commissions',[AppReferralController::class,'commissions'])->name('user.referral.commissions');

    Route::get('/withdraw', 'User\WithdrawController@index')->name('user-wwt-index');
    Route::get('/withdraw/create', 'User\WithdrawController@create')->name('user-wwt-create')->middleware(KYC::class);
    Route::post('/withdraw/create', 'User\WithdrawController@store')->name('user-wwt-store')->middleware(KYC::class);

    Route::get('/invests', 'User\OrderController@orders')->name('user-invests');
    Route::get('/investment/{id}', 'User\OrderController@order')->name('user-order');
    Route::get('/payouts', 'User\OrderController@payouts')->name('user-payouts');

    Route::get('/balance-transfer','User\SendController@index')->name('balance.transfer.index');
    Route::post('/balance-transfer','User\SendController@store')->name('balance.transfer.store');

    Route::get('/deposits',[DepositController::class,'index'])->name('user.deposit.index');
    Route::get('/deposit/create',[DepositController::class,'create'])->name('user.deposit.create');

    Route::post('/deposit/stripe-submit', [StripeController::class,'store'])->name('deposit.stripe.submit');

    Route::post('/deposit/paystack/submit', [PaystackController::class,'store'])->name('deposit.paystack.submit');

    Route::post('/paypal-submit', [PaypalController::class,'store'])->name('deposit.paypal.submit');
    Route::get('/paypal/deposit/notify', [PaypalController::class,'notify'])->name('deposit.paypal.notify');
    Route::get('/paypal/deposit/cancle', [PaypalController::class,'cancle'])->name('deposit.paypal.cancle');

    Route::post('/instamojo-submit',[InstamojoController::class,'store'])->name('deposit.instamojo.submit');
    Route::get('/instamojo-notify',[InstamojoController::class,'notify'])->name('deposit.instamojo.notify');

    Route::post('/deposit/paytm-submit', [PaytmController::class,'store'])->name('deposit.paytm.submit');
    Route::post('/deposit/paytm-callback', [PaytmController::class,'paytmCallback'])->name('deposit.paytm.notify');

    Route::post('/deposit/razorpay-submit', [RazorpayController::class,'store'])->name('deposit.razorpay.submit');
    Route::post('/deposit/razorpay-notify', [RazorpayController::class,'notify'])->name('deposit.razorpay.notify');

    Route::post('/deposit/molly-submit', [MollieController::class,'store'])->name('deposit.molly.submit');
    Route::get('/deposit/molly-notify', [MollieController::class,'notify'])->name('deposit.molly.notify');

    Route::post('/deposit/flutter/submit', [FlutterwaveController::class,'store'])->name('deposit.flutter.submit');
    Route::post('/deposit/flutter/notify', [FlutterwaveController::class,'notify'])->name('deposit.flutter.notify');

    Route::post('/authorize-submit', [AuthorizeController::class,'store'])->name('deposit.authorize.submit');


    Route::get('/plan','User\PlanController@planChoose')->name('user.plan');


    Route::get('/affilate/code', 'User\UserController@affilate_code')->name('user-affilate-code');


    Route::get('/notf/show', 'User\NotificationController@user_notf_show')->name('customer-notf-show');
    Route::get('/notf/count','User\NotificationController@user_notf_count')->name('customer-notf-count');
    Route::get('/notf/clear','User\NotificationController@user_notf_clear')->name('customer-notf-clear');


    Route::get('admin/messages', 'User\MessageController@adminmessages')->name('user-message-index');
    Route::get('admin/message/{id}', 'User\MessageController@adminmessage')->name('user-message-show');
    Route::post('admin/message/post', 'User\MessageController@adminpostmessage')->name('user-message-store');
    Route::get('admin/message/{id}/delete', 'User\MessageController@adminmessagedelete')->name('user-message-delete1');
    Route::post('admin/user/send/message', 'User\MessageController@adminusercontact')->name('user-send-message');
    Route::get('admin/message/load/{id}', 'User\MessageController@messageload')->name('user-message-load');

    Route::get('/reset', 'User\UserController@resetform')->name('user-reset');
    Route::post('/reset', 'User\UserController@reset')->name('user-reset-submit');

    Route::get('/deposit/payment/{number}',[UserDepositController::class,'sendDeposit'])->name('user.deposit.send');
    Route::post('/api/deposit/stripe/submit',[DepositStripeController::class,'store'])->name('api.user.deposit.stripe.submit');

    Route::post('/api/deposit/paypal/submit',[DepositPaypalController::class,'store'])->name('api.deposit.paypal.store');
    Route::get('/api/deposit/paypal/notify',[DepositPaypalController::class,'notify'])->name('api.deposit.paypal.notify');

    Route::post('/api/deposit/instamojo/submit', [DepositInstamojoController::class,'store'])->name('api.deposit.instamojo.submit');
    Route::get('/api/deposit/instamojo-notify',[DepositInstamojoController::class,'notify'])->name('api.deposit.instamojo.notify');

    Route::post('/api/deposit/paytm-submit', [DepositPaytmController::class,'store'])->name('api.deposit.paytm.submit');;
    Route::post('/api/deposit/paytm-callback', [DepositPaytmController::class,'paytmCallback'])->name('api.deposit.paytm.notify');

    Route::post('/api/deposit/razorpay-submit', [DepositRazorpayController::class,'store'])->name('api.deposit.razorpay.submit');
    Route::post('/api/deposit/razorpay-callback',[DepositRazorpayController::class,'razorCallback'])->name('api.deposit.razorpay.notify');

    Route::post('/api/deposit/authorize-submit', [DepositAuthorizeController::class,'store'])->name('api.deposit.authorize.submit');

    Route::post('/api/deposit/flutter/submit', [DepositFlutterwaveController::class,'store'])->name('api.deposit.flutter.submit');
    Route::post('/api/deposit/flutter/notify', [DepositFlutterwaveController::class,'notify'])->name('api.deposit.flutter.notify');

    Route::post('/api/deposit/molly-submit', [DepositMollieController::class,'store'])->name('api.deposit.molly.submit');
    Route::get('/api/deposit/molly-notify', [DepositMollieController::class,'notify'])->name('api.deposit.molly.notify');

    Route::get('/invest/payment/{number}',[InvestController::class,'sendInvest'])->name('user.invest.send');
    Route::post('/api/invest/stripe/submit',[InvestStripeController::class,'store'])->name('api.user.invest.stripe.submit');

    Route::post('/api/invest/paypal/submit',[InvestPaypalController::class,'store'])->name('api.invest.paypal.store');
    Route::get('/api/invest/paypal/notify',[InvestPaypalController::class,'notify'])->name('api.invest.paypal.notify');

    Route::post('/api/invest/instamojo/submit', [InvestInstamojoController::class,'store'])->name('api.invest.instamojo.submit');
    Route::get('/api/invest/instamojo-notify',[InvestInstamojoController::class,'notify'])->name('api.invest.instamojo.notify');

    Route::post('/api/invest/paytm-submit', [InvestPaytmController::class,'store'])->name('api.invest.paytm.submit');
    Route::post('/api/invest/paytm-callback', [InvestPaytmController::class,'paytmCallback'])->name('api.invest.paytm.notify');

    Route::post('/api/invest/razorpay-submit', [InvestRazorpayController::class,'store'])->name('api.invest.razorpay.submit');
    Route::post('/api/invest/razorpay-callback',[InvestRazorpayController::class,'razorCallback'])->name('api.invest.razorpay.notify');

    Route::post('/api/invest/authorize-submit', [InvestAuthorizeController::class,'store'])->name('api.invest.authorize.submit');

    Route::post('/api/invest/flutter/submit', [InvestFlutterwaveController::class,'store'])->name('api.invest.flutter.submit');
    Route::post('/api/invest/flutter/notify', [InvestFlutterwaveController::class,'notify'])->name('api.invest.flutter.notify');

    Route::post('/api/invest/manual-submit', [ManualController::class,'store'])->name('api.invest.manual.submit');
    Route::post('/api/invest/wallet-submit', [WalletController::class,'store'])->name('api.invest.wallet.submit');

    Route::post('/api/invest/parisi-submit', [ParsiBankController::class,'store'])->name('api.invest.parisi.submit');
    Route::any('/api/invest/parisi-bank', [ParsiBankController::class,'notify'])->name('api.invest.parisi.notify');

    Route::post('/api/invest/paystack/submit', [InvestPaystackController::class,'store'])->name('api.invest.paystack.submit');

    Route::post('/api/invest/molly-submit', [InvestMollieController::class,'store'])->name('api.invest.molly.submit');
    Route::get('/api/invest/molly-notify', [InvestMollieController::class,'notify'])->name('api.invest.molly.notify');

    Route::post('/api/invest/coingate-submit', [CoinGateController::class,'deposit'])->name('api.invest.coingate.submit');
    Route::post('/api/invest/coingate/notify', [CoinGateController::class,'coingetCallback'])->name('api.invest.coingate.notify');

    Route::post('/api/invest/coinpay-submit', [CoinPaymentController::class,'deposit'])->name('api.invest.coinpay.submit');
    Route::post('/api/invest/coinpay/notify', [CoinPaymentController::class,'coincallback'])->name('api.invest.coinpay.notify');
    Route::get('/api/invest/invest/coinpay', [CoinPaymentController::class,'blockInvest'])->name('api.invest.coinpay.invest');

    Route::post('/api/invest/blockio-submit', [BlockIOController::class,'invest'])->name('api.invest.blockio.submit');
    Route::post('/api/invest/blockio/notify', [BlockIOController::class,'blockiocallback'])->name('api.invest.blockio.notify');
    Route::get('/api/invest/invest/blockio/info', [BlockIOController::class,'blockioInvest'])->name('api.invest.blockio.invest');

    Route::post('/api/invest/blockchain-submit', [BlockChainController::class,'deposit'])->name('api.invest.blockchain.submit');
    Route::post('/api/invest/blockchain/notify', [BlockChainController::class,'chaincallback'])->name('api.invest.blockchain.notify');
    Route::get('/api/invest/invest/blockchain/info', [BlockChainController::class,'blockchainInvest'])->name('api.invest.blockchain.invest');
  });


  Route::get('/logout', 'User\LoginController@logout')->name('user-logout');

});

    // ----------------- In Last Of Admin


    // ------------------ MID ----------------------
    Route::post('the/genius/ocean/2441139', 'Frontend\FrontendController@subscription');
    Route::get('finalize', 'Frontend\FrontendController@finalize');

    Route::get('/', 'Frontend\FrontendController@index')->name('front.index');

    Route::get('blogs', 'Frontend\FrontendController@blog')->name('front.blog');
    Route::get('blog/{slug}', 'Frontend\FrontendController@blogdetails')->name('blog.details');
    Route::get('/blog-search','Frontend\FrontendController@blogsearch')->name('front.blogsearch');
    Route::get('/blog/category/{slug}','Frontend\FrontendController@blogcategory')->name('front.blogcategory');
    Route::get('/blog/tag/{slug}','Frontend\FrontendController@blogtags')->name('front.blogtags');
    Route::get('/blog/archive/{slug}','Frontend\FrontendController@blogarchive')->name('front.blogarchive');

    Route::get('/pricing-plan','Frontend\FrontendController@plan')->name('front.pricing');
    Route::get('/services','Frontend\FrontendController@services')->name('front.services');

    Route::get('/contact', 'Frontend\FrontendController@contact')->name('front.contact');
    Route::post('/contact','Frontend\FrontendController@contactemail')->name('front.contact.submit');
    Route::get('/faq', 'Frontend\FrontendController@faq')->name('front.faq');
    Route::get('/{slug}','Frontend\FrontendController@page')->name('front.page');

    Route::get('/invest/{id}','Frontend\CheckoutController@checkout')->name('front.checkout');
    Route::get('/payment/return','Frontend\CheckoutController@payreturn')->name('front.payreturn');

    Route::post('/paypal-submit', 'Frontend\PaymentController@store')->name('paypal.submit');
    Route::get('/paypal/notify', 'Frontend\PaymentController@notify')->name('paypal.notify');
    Route::get('/payment/cancle', 'Frontend\PaymentController@cancle')->name('payment.cancle');

    Route::post('/stripe-submit', 'Frontend\StripeController@store')->name('stripe.submit');

    Route::post('/blockchain-submit', 'Frontend\BlockChainController@deposit')->name('blockchain.submit');
    Route::post('/blockchain/notify', 'Frontend\BlockChainController@chaincallback')->name('blockchain.notify');
    Route::get('/invest/blockchain/info', 'Frontend\BlockChainController@blockchainInvest')->name('blockchain.invest');

    Route::post('/coinpay-submit', 'Frontend\CoinPaymentController@deposit')->name('coinpay.submit');
    Route::post('/coinpay/notify', 'Frontend\CoinPaymentController@coincallback')->name('coinpay.notify');
    Route::get('/invest/coinpay', 'Frontend\CoinPaymentController@blockInvest')->name('coinpay.invest');

    Route::post('/blockio-submit', 'Frontend\BlockIOController@invest')->name('blockio.submit');
    Route::post('/blockio/notify', 'Frontend\BlockIOController@blockiocallback')->name('blockio.notify');
    Route::get('/invest/blockio/info', 'Frontend\BlockIOController@blockioInvest')->name('blockio.invest');

    Route::post('/coingate-submit', 'Frontend\CoinGateController@deposit')->name('coingate.submit');
    Route::post('/coingate/notify', 'Frontend\CoinGateController@coingetCallback')->name('coingate.notify');

    Route::post('/coincommerce-submit', 'Frontend\CoinbaseCommerce@deposit')->name('coincommerce.submit');

    Route::post('/invest/instamojo-submit', 'Frontend\InstamojoController@store')->name('instamojo.submit');
    Route::get('/invest/instamojo-notify/callback', 'Frontend\InstamojoController@notify')->name('instamojo.notify');

    Route::post('/razorpay-submit', 'Frontend\RazorpayController@store')->name('user.razorpay.submit');
    Route::post('/razorpay-notify', 'Frontend\RazorpayController@notify')->name('user.razorpay.notify');

    Route::post('/molly-submit', 'Frontend\MollieController@store')->name('molly.submit');
    Route::get('/molly-notify', 'Frontend\MollieController@notify')->name('molly.notify');

    Route::post('/authorize-submit', 'Frontend\AuthorizeController@store')->name('authorize.submit');

    Route::post('/perfect-money-return', 'Frontend\CoinbaseCommerce@deposit')->name('perfect.money.return');

    Route::get('/coinbase/commerce/submit', 'Frontend\CoinbaseCommerce@store');
    Route::get('/coinbase/commerce/notify', 'Frontend\CoinbaseCommerce@notify');
    Route::post('/perfect/notify', 'PaymentController@perfect_notify')->name('payment.perfect');

    Route::post('/stripe/commerce/submit', 'Frontend\StripeHostedController@store')->name('stripe.v3.submit');
    Route::get('/skrill/commerce/submit', 'Frontend\SkrillController@store');

    Route::post('/paystack/submit', 'Frontend\PaystackController@store')->name('paystack.submit');

    Route::post('/flutter/submit', 'Frontend\FlutterwaveController@store')->name('flutter.submit');
    Route::post('/flutter/notify', 'Frontend\FlutterwaveController@notify')->name('flutter.notify');

    Route::post('/paytm-submit', 'Frontend\PaytmController@store')->name('paytm.submit');
    Route::post('/paytm-callback', 'Frontend\PaytmController@paytmCallback')->name('paytm.notify');

    Route::post('/manual-submit', 'Frontend\ManualController@store')->name('manual.submit');
    Route::post('/wallet-submit', 'Frontend\WalletController@store')->name('wallet.submit');

    Route::post('/parisi-submit', 'Frontend\ParisiBankController@store')->name('parisi.submit');
    Route::any('/parisi-bank', 'Frontend\ParisiBankController@notify')->name('parisi.notify');


    Route::get('/currency/{id}', 'Frontend\FrontendController@currency')->name('front.currency');
    Route::get('/language/{id}', 'Frontend\FrontendController@language')->name('front.language');
    Route::get('/crypto/setdata', 'Frontend\FrontendController@setdata')->name('front.setdata');

