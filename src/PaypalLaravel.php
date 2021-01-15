<?php
/**
 * Author: Emmanuel Mnzava
 * Email: epmnzava@gmail.com
 */
namespace Epmnzava\PaypalLaravel;
use Epmnzava\PaypalLaravel\OAuth\OAuthConsumer;
use Epmnzava\PaypalLaravel\OAuth\OAuthRequest;
use Epmnzava\PaypalLaravel\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use Epmnzava\PaypalLaravel\PaypalUtil;

class PaypalLaravel
{
    // Build your next great package.

    private string $token;





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


         $this->token= json_decode($response)->access_token;



        
    }

    /**
     * POST
     * /v1/payments/payment/
     * used to create payment
     */


    public function CreatePayment($amount,$tax,$shipping,$handling_fee,$description){
        $token=$this->getAccessToken();

        if(config("paypal-laravel.environment")=="test"){
            $api=new PaypalUtil();
            
            $response=$api->create_payment_util($token,config("paypal-laravel.sandbox_endpoint"),$amount,0,0,0,$description);

        }
           else{
            $api=new PaypalUtil();
            $response=$api->create_payment_util($token,config("paypal-laravel.live_endpoint"),$amount,0,0,0,$description);

             }
    

             echo $response;

             exit;
             return $response;



    }


  /**
   *  POST
   * /v2/invoicing/generate-next-invoice-number

   */


   public function generateInvoiceNumber(){

    $this->getAccessToken();
    $response=null;

    if(config("paypal-laravel.environment")=="test"){
        $api=new PaypalUtil();
        $response=$api->generate_invoice(config("paypal-laravel.sandbox_endpoint")."/v2/invoicing/generate-next-invoice-number",$this->token);
        }
       else{
        $api=new PaypalUtil();
        $response=$api->generate_invoice(config("paypal-laravel.live_endpoint")."/v2/invoicing/generate-next-invoice-number",$this->token);
         }


         echo $response;



   }


   /**
    *  GET
    * /v2/invoicing/invoices
    */


    public function listInvoices(){
        $this->getAccessToken();
        $response=null;
    
        if(config("paypal-laravel.environment")=="test"){
            $api=new PaypalUtil();
            $response=$api->getFromPaypal(config("paypal-laravel.sandbox_endpoint")."/v2/invoicing/invoices",$this->token);
            }
           else{
            $api=new PaypalUtil();
            $response=$api->getFromPaypal(config("paypal-laravel.live_endpoint")."/v2/invoicing/invoices",$this->token);
             }
    

        

        echo $response;
    }


   /**
    * POST 
    *
    *  /v2/checkout/orders 
    */

     public function createOrder($reference_id,$amount,$items=[]){
        $this->getAccessToken();

        $response=null;
    



        if(config("paypal-laravel.environment")=="test"){
            $api=new PaypalUtil();
            $response=$api->getCreateOrder(config("paypal-laravel.sandbox_endpoint")."/v2/checkout/orders",$this->token,$reference_id,config("paypal-laravel.currency_code"),$amount);
            }
           else{
            $api=new PaypalUtil();
            $response=$api->getCreateOrder(config("paypal-laravel.live_endpoint")."/v2/checkout/orders",$this->token,$reference_id,config("paypal-laravel.currency_code"),$amount);
             }
    
             $order_id=json_decode($response)->id;
             $order_links=json_decode($response)->links;
             $checkout_link=$order_links[1]->href;
$response_array=["order_id"=>$order_id,"checkout_link"=>$checkout_link];
             return $response_array;

    /// $this->readLink(json_decode($response)->links[0]);


     }


     public function readLink($link){
        $this->getAccessToken();

        $response=null;
    

        $api=new PaypalUtil();
        $response=$api->getFromPaypal($link,$this->token);

       echo $response;

     }





    
}
