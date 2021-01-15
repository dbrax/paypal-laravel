<?php

namespace Epmnzava\PaypalLaravel;



class PaypalUtil{


   public function fetch_token(string $url,string $authorization) {
$curl = curl_init();

$api_url=$url."/v1/oauth2/token";
curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "grant_type=client_credentials",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic ".$authorization,
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: d99b34bb-eaea-7fd5-945e-62851bb14cb8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

return $response;
  
}


public function create_payment_util($token,$url,$amount,$shipping=0,$tax=0,$handling_fee=0,$description){


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "".$url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => '{
  "intent": "sale",
  "redirect_urls": {
    "return_url": "'.config('paypal-laravel.return_url').'",
    "cancel_url": "'.config('paypal-laravel.cancel_url').'"
  },
  "payer": {
    "payment_method": "paypal"
  },
  "transactions": [
    {
      "amount": {
        "total": "'.$amount.'",
        "currency": "'.config('paypal-laravel.currency_code').'",
        "details": {
          "subtotal": "30.00",
          "tax": "'.$tax.'",
          "shipping": "'.$shipping.'",
          "handling_fee": "'.$handling_fee.'",
          "insurance": "0",
          "shipping_discount": "0"
        }
      },
      "description": "'.$description.'",
     
    }
  ]
}',
  CURLOPT_HTTPHEADER => array(
    'accept: application/json',
    'accept-language: en_US',
    'authorization: Bearer '.$token,
    'content-type: application/json'
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

return $response;


}

public function generate_invoice(string $url,string $token){
  $curl = curl_init();

  $api_url=$url;
  curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "grant_type=client_credentials",
    CURLOPT_HTTPHEADER => array(
      "authorization: Bearer ".$token,
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  return $response;


}

public function getCreateOrder($url,$token,$reference_id,$currency_code,$amount){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"intent\": \"CAPTURE\",\n  \"purchase_units\": [\n    {\n      \"reference_id\":\"$reference_id\",  \n      \"amount\": {\n        \"currency_code\": \"$currency_code\",\n        \"value\": \"$amount\"\n      }\n    }\n  ]\n}");
  
  $headers = array();
  $headers[] = 'Content-Type: application/json';
  $headers[] = 'Authorization: Bearer '.$token;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
  $response = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);

return $response;

}


public function getFromPaypal($url,$token){

  $curl = curl_init();

  $api_url=$url;
  curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: Bearer ".$token,
      "cache-control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  return $response;


}

}