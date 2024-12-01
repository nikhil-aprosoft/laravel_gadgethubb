<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayUController extends Controller
{
    public function paymentRequest(Request $request)
    {
        $apiEndpoint = "https://test.payu.in/_payment";

        $merchantKey = env('PAYU_MERCHANT_KEY');
        $salt = env('PAYU_SALT');

        $amount = "100.00";
        $productInfo = "Test Product";
        $firstName = "John";
        $email = "john@example.com";
        $phone = "9999999999";
        $txnId = "TXN" . time();
        $surl = config('app.url') . "payment-success";
        $furl = config('app.url') . "payment-failure";

        $params = [
            "key" => $merchantKey,
            "txnid" => $txnId,
            "amount" => $amount,
            "productinfo" => $productInfo,
            "firstname" => $firstName,
            "email" => $email,
            "phone" => $phone,
            "surl" => $surl,
            "furl" => $furl,
            "udf1" => "", // Include udf1 to udf5 explicitly
            "udf2" => "",
            "udf3" => "",
            "udf4" => "",
            "udf5" => "",
        ];

        // Generate the hash
        $hash = $this->generateHash($params, $salt);
        $params["hash"] = $hash;

        $form = $this->buildPaymentForm($apiEndpoint, $params);

        return response($form);
    }

    public function buildPaymentForm($apiEndpoint, $params)
    {
        $form = '<form method="POST" action="' . htmlspecialchars($apiEndpoint) . '">';
        foreach ($params as $key => $value) {
            $form .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }
        $form .= '<button type="submit">Proceed to Payment</button>';
        $form .= '</form>';
        return $form;
    }

    public function generateHash($params, $salt)
    {
        // Correct formula including udf1 to udf5
        $hashString = $params["key"] . "|" . $params["txnid"] . "|" . $params["amount"] . "|" . $params["productinfo"] . "|" . $params["firstname"] . "|" . $params["email"] . "|" . $params["udf1"] . "|" . $params["udf2"] . "|" . $params["udf3"] . "|" . $params["udf4"] . "|" . $params["udf5"] . "||||||" . $salt;

        // Generate the hash
        return hash("sha512", $hashString);
    }

    public function paymentSuccess(Request $request)
    {
        \Log::info('Payment Success Data:', $request->all());
    
        return response()->json(['status' => 'success', 'data' => $request->all()]);
    }
    
    public function paymentFailure(Request $request)
    {
        \Log::info('Payment Failure Data:', $request->all());
    
        return response()->json(['status' => 'failure', 'data' => $request->all()]);
    }
    
}
