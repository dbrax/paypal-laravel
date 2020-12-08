<?php

namespace Epmnzava\PaypalLaravel;
use Epmnzava\PaypalLaravel\OAuth\OAuthConsumer;
use Epmnzava\PaypalLaravel\OAuth\OAuthRequest;
use Epmnzava\PaypalLaravel\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use Epmnzava\PaypalLaravel\PaypalUtil;

class PaypalLaravel
{
    // Build your next great package.



    public function getAccessToken(){

        // create authorization here...

         $response=null;
        $authorization=base64_encode(config("paypal-laravel.client_id").":".config("paypal-laravel.client_secret"));
        if(config("paypal-laravel.environment")=="test"){
        $api=new PaypalUtil();
        $response=$api->fetch_token(config("paypal-laravel.sandbox_endpoint"),$authorization);
        }
       else{
        $api=new PaypalUtil();
        $response=$api->fetch_token(config("paypal-laravel.live_endpoint"),$authorization);
         }


         echo $response;



        
    }












    
}
