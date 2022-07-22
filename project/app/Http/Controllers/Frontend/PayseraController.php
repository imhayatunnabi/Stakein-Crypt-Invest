<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PayseraController extends Controller{

    public function store(Type $var = null)
    {
        try {
            WebToPay::redirectToPayment([
               'projectid' => '{YOUR_PROJECT_ID}',
               'sign_password' => '{YOUR_PROJECT_PASSWORD}',
               'orderid' => 0,
               'amount' => 1000,
               'currency' => 'EUR',
               'country' => 'LT',
               'accepturl' => getSelfUrl() . '/accept.php',
               'cancelurl' => getSelfUrl() . '/cancel.php',
               'callbackurl' => getSelfUrl() . '/callback.php',
               'test' => 0,
           ]);
       } catch (Exception $exception) {
           echo get_class($exception) . ':' . $exception->getMessage();
       }
    }


public function isPaymentValid(array $order, array $response)
{
    if (array_key_exists('payamount', $response) === false) {
        if ($order['amount'] !== $response['amount'] || $order['currency'] !== $response['currency']) {
            throw new Exception('Wrong payment amount');
        }
    } else {
        if ($order['amount'] !== $response['payamount'] || $order['currency'] !== $response['paycurrency']) {
            throw new Exception('Wrong payment amount');
        }
    }
 
    return true;

 
    try {
        $response = WebToPay::validateAndParseData(
            $_REQUEST,
            '{YOUR_PROJECT_ID}',
            '{YOUR_PROJECT_PASSWORD}'
        );
    
        if ($response['status'] === '1' || $response['status'] === '3') {

    
            echo 'OK';
        } else {
            throw new Exception('Payment was not successful');
        }
    } catch (Exception $exception) {
        echo get_class($exception) . ':' . $exception->getMessage();
    }

}



public function getSelfUrl(): string
{
    $url = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'));
 
    if (isset($_SERVER['HTTPS']) === true) {
        $url .= ($_SERVER['HTTPS'] === 'on') ? 's' : '';
    }
 
    $url .= '://' . $_SERVER['HTTP_HOST'];
 
    if (isset($_SERVER['SERVER_PORT']) === true && $_SERVER['SERVER_PORT'] !== '80') {
        $url .= ':' . $_SERVER['SERVER_PORT'];
    }
 
    $url .= dirname($_SERVER['SCRIPT_NAME']);
 
    return $url;
}






}