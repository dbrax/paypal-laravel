<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Email: epmnzava@gmail.com
 * Github:https://github.com/dbrax/paypal-laravel
 *
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




    /**
     * This function is there to get a token from paypal api
     */
    public function getAccessToken()
    {

        // create authorization here...

        $response = null;
        $authorization = base64_encode(config("paypal-laravel.client_id") . ":" . config("paypal-laravel.client_secret"));
        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();
            $response = $api->fetch_token(config("paypal-laravel.sandbox_endpoint"), $authorization);
        } else {
            $api = new PaypalUtil();
            $response = $api->fetch_token(config("paypal-laravel.live_endpoint"), $authorization);
        }


        $this->token = json_decode($response)->access_token;
    }

    /**
     * @param int $amount
     * @param $tax
     * @param $shipping
     * @param $handling_fee
     * @param $description
     * @return array
     *
     * /v1/payments/payment/
     * used to setup payment with paypal and will return payment id this id can be saved on your billing or payment history table
     *
     */
    public function CreatePayment($amount, $tax, $shipping, $handling_fee, $description) : Array
    {
        $this->getAccessToken();

        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();

            $response = $api->create_payment_util($this->token, config("paypal-laravel.sandbox_endpoint"), $amount, 0, 0, 0, $description);
        } else {
            $api = new PaypalUtil();
            $response = $api->create_payment_util($this->token, config("paypal-laravel.live_endpoint"), $amount, 0, 0, 0, $description);
        }



        $payment_id = json_decode($response)->id;
        $payment_links = json_decode($response)->links;
        $checkout_link = $payment_links[1]->href;

        //remember to save payment_id once it returns
        //add validations here to check if payment_id is available
        $response_array = ["payment_id" => $payment_id, "checkout_link" => $checkout_link];

        return $response_array;
    }



    /**
     * @param $PayeID
     * @param $payer_id
     * @return bool|string
     *
     * /v1/payments/payment/PAY-XXX/execute
     */
    public function executePayment($PayeID,$payer_id){

    $this->getAccessToken();

        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();

            $url=config("paypal-laravel.sandbox_endpoint")."/v1/payments/payment/".$PayeID."/execute";


            $response = $api->executepayment($this->token, $url,$payer_id);
        } else {

            $api = new PaypalUtil();

            $url=config("paypal-laravel.live_endpoint")."/v1/payments/payment/".$PayeID."/execute";

            $response = $api->executepayment($this->token, $url,$payer_id);
        }


        return $response;


    }

    /**
     *  POST
     * /v2/invoicing/generate-next-invoice-number

     */


    public function generateInvoiceNumber()
    {

        $this->getAccessToken();
        $response = null;

        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();
            $response = $api->generate_invoice(config("paypal-laravel.sandbox_endpoint") . "/v2/invoicing/generate-next-invoice-number", $this->token);
        } else {
            $api = new PaypalUtil();
            $response = $api->generate_invoice(config("paypal-laravel.live_endpoint") . "/v2/invoicing/generate-next-invoice-number", $this->token);
        }


        echo $response;
    }


    /**
     *  GET
     * /v2/invoicing/invoices
     */

    public function listInvoices()
    {
        $this->getAccessToken();
        $response = null;

        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();
            $response = $api->getFromPaypal(config("paypal-laravel.sandbox_endpoint") . "/v2/invoicing/invoices", $this->token);
        } else {
            $api = new PaypalUtil();
            $response = $api->getFromPaypal(config("paypal-laravel.live_endpoint") . "/v2/invoicing/invoices", $this->token);
        }




        echo $response;
    }



    /**
     * @param $reference_id
     * @param $amount
     * @param array $items
     * @return array
     *
     * Function to create an order  /v2/checkout/orders
     */

    public function createOrder($reference_id, $amount, $items = [])
    {
        $this->getAccessToken();

        $response = null;




        if (config("paypal-laravel.environment") == "test") {
            $api = new PaypalUtil();
            $response = $api->getCreateOrder(config("paypal-laravel.sandbox_endpoint") . "/v2/checkout/orders", $this->token, $reference_id, config("paypal-laravel.currency_code"), $amount);
        } else {
            $api = new PaypalUtil();
            $response = $api->getCreateOrder(config("paypal-laravel.live_endpoint") . "/v2/checkout/orders", $this->token, $reference_id, config("paypal-laravel.currency_code"), $amount);
        }

        $order_id = json_decode($response)->id;
        $order_links = json_decode($response)->links;
        $checkout_link = $order_links[1]->href;
        $response_array = ["order_id" => $order_id, "checkout_link" => $checkout_link];
        return $response_array;


    }

}
