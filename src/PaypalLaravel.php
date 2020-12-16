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
    

        $post_array=$this->create_purchase_units($reference_id,$amount,$items);


        if(config("paypal-laravel.environment")=="test"){
            $api=new PaypalUtil();
            $response=$api->getCreateOrder(config("paypal-laravel.sandbox_endpoint")."/v2/checkout/orders",$this->token,$post_array);
            }
           else{
            $api=new PaypalUtil();
            $response=$api->getCreateOrder(config("paypal-laravel.live_endpoint")."/v2/checkout/orders",$this->token,$post_array);
             }
    

        

        echo $response;


     }


public function create_purchase_units($reference_id,$amount,$items){
    return array(
        'intent' => 'CAPTURE',
        'application_context' =>
            array(
                
                'return_url' => config('paypal-laravel.return_url'),
                'cancel_url' => config('paypal-laravel.cancel_url'),
                'brand_name' => config('paypal-laravel.org_name'),
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
            ),
        'purchase_units' =>
            array(
                0 =>
                    array(
                        'reference_id' => $reference_id,
                        
                          'amount' =>
                            array(
                                'currency_code' => config("paypal-laravel.currency_code"),
                                'value' => $amount
                                   
                            ),
                      
                     
                    ),
            ),
    );

}

    
}
