<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\UserNotification;
use App\Repositories\OrderRepository;
use App\User;
use Carbon\Carbon;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{
    public $orderRepositorty;

    public function __construct(OrderRepository $orderRepositorty)
    {
        $this->orderRepositorty = $orderRepositorty;
    }

    public function store(Request $request){
        
        $settings = Generalsetting::find(1);
        
        $authorizeinfo    = PaymentGateway::whereKeyword('authorize.net')->first();
        $authorizesettings= $authorizeinfo->convertAutoData();

        $item_name = $settings->title." Order";
        $item_number = Str::random(4).time();
        $item_amount = $request->invest;
        
     
        $validator = Validator::make($request->all(),[
            'cardNumber' => 'required',
            'cardCVC' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->passes()) {
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName($authorizesettings['login_id']);
            $merchantAuthentication->setTransactionKey($authorizesettings['txn_key']);

            $refId = 'ref' . time();

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber(str_replace(' ','',$request->cardNumber));
            $year = $request->year;
            $month = $request->month;
            $creditCard->setExpirationDate($year.'-'.$month);
            $creditCard->setCardCode($request->cardCVC);

            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
        
            $orderr = new AnetAPI\OrderType();
            $orderr->setInvoiceNumber($item_number);
            $orderr->setDescription($item_name);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction"); 
            $transactionRequestType->setAmount($item_amount);
            $transactionRequestType->setOrder($orderr);
            $transactionRequestType->setPayment($paymentOne);
  
            $requestt = new AnetAPI\CreateTransactionRequest();
            $requestt->setMerchantAuthentication($merchantAuthentication);
            $requestt->setRefId($refId);
            $requestt->setTransactionRequest($transactionRequestType);
        
            $controller = new AnetController\CreateTransactionController($requestt);
            if($authorizesettings['sandbox_check'] == 1){
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else {
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);                
            }

        
            if ($response != null) {
                if ($response->getMessages()->getResultCode() == "Ok") {
                    $tresponse = $response->getTransactionResponse();

                
                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $addionalData = ['item_number'=>$item_number,'txnid'=>$tresponse->getTransId()];
                        $this->orderRepositorty->order($request,'complete',$addionalData);
                        return redirect()->route('front.payreturn');

                    } else {
                        return back()->with('unsuccess', 'Payment Failed.');
                    }
                } else {
                    return back()->with('unsuccess', 'Payment Failed.');
                }      
            } else {
                return back()->with('unsuccess', 'Payment Failed.');
            }

        }
        return back()->with('unsuccess', 'Invalid Payment Details.');
    }
}
