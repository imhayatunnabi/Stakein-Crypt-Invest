<?php

namespace App\Http\Controllers\Api\Payment\Deposit;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{
    public function store(Request $request){
        
        if(!$request->has('deposit_number')){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid Request']);
        }
    
        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Deposit";
        $deposit_number = $request->deposit_number;
        $order = Deposit::where('deposit_number',$deposit_number)->first();
        $input = $request->all();
        
        $curr = Currency::where('name','=',$order->currency_code)->first();
        $item_amount = $order->amount ;
             
        $authorizeinfo    = PaymentGateway::whereKeyword('authorize.net')->first();
        $authorizesettings= $authorizeinfo->convertAutoData();

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
            $orderr->setInvoiceNumber($deposit_number);
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
                        $order['method'] = $request->method;
                        $order['txnid'] = $tresponse->getTransId();
                        $order['status'] = 'complete';
                        $order->update();
    

                        $user = auth()->user();
                        $user->income += $order->amount;
                        $user->save();
            
                        return redirect()->route('user.deposit.send',$deposit_number)->with('success','Deposit amount ('.$request->amount.') successfully!');

                    } else {
                        return redirect()->route('user.deposit.send',$deposit_number)->with('unsuccess', 'Payment Failed.');
                    }
                } else {
                    return redirect()->route('user.deposit.send',$deposit_number)->with('unsuccess', 'Payment Failed.');
                }      
            } else {
                return redirect()->route('user.deposit.send',$deposit_number)->with('unsuccess', 'Payment Failed.');
            }

        }
            return back()->with('unsuccess', 'Invalid Payment Details.');
        }
    
}
