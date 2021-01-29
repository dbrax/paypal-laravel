<?php

return [

      /*
    |--------------------------------------------------------------------------
    | Paypal  Sandbox Endpoint
    |--------------------------------------------------------------------------
    | This value is the sandbox endpoint given by paypal you can find it on developer
    | Incase it changes you can change the end point here 
    | 
    | 
    |
    */


    "sandbox_endpoint"=>"https://api-m.sandbox.paypal.com",

      /*
    |--------------------------------------------------------------------------
    | Paypal Live endpoint
    |--------------------------------------------------------------------------
    | This value is the live or production endpoint given by paypal you can find it on developer
    | Incase it changes you can change the end point here
    | 
    | 
    |
    */


    "live_endpoint"=>"https://api-m.paypal.com",

      /*
    |--------------------------------------------------------------------------
    | Paypal Client Id
    |--------------------------------------------------------------------------
    |
    | Client id provided by paypal add it here
    | 
    | 
    |
    */


    "client_id"=>env("PAYPAL_CLIENT_ID"),

      /*
    |--------------------------------------------------------------------------
    | Paypal Client Secret
    |--------------------------------------------------------------------------
    |
    | Client secret given by paypal put it here.
    | 
    | 
    |
    */


    "client_secret"=>env("PAYPAL_CLIENT_SECRET"),
      /*
    |--------------------------------------------------------------------------
    | Your Organization Name
    |--------------------------------------------------------------------------
    |
    | Here write your organization name or initials or business name
    | 
    | 
    |
    */


    "org_name"=>env("PAYPAL_ORG_NAME"),

      /*
    |--------------------------------------------------------------------------
    | Paypal Redirect URL
    |--------------------------------------------------------------------------
    |
    | Your Redirect url goes here where paypal will redirect once payment is done.
    | 
    | 
    |
    */


    "return_url"=>env("PAYPAL_REDIRECT_URL"),

      /*
    |--------------------------------------------------------------------------
    | Paypal Cancel URL
    |--------------------------------------------------------------------------
    |
    | Here goes your cancel url where paypal will redirect once payment is canceled
    | 
    | 
    |
    */



    
    "cancel_url"=>env("PAYPAL_CANCEL_URL"),


      /*
    |--------------------------------------------------------------------------
    | Paypal Currency
    |--------------------------------------------------------------------------
    |
    |Here goes the currency that your customers will be paying in 
    | 
    | 
    |
    */



    "currency_code"=>env("PAYPAL_CURRENCY_CODE"),


      /*
    |--------------------------------------------------------------------------
    | Code environment
    |--------------------------------------------------------------------------
    |
    | Here define whether your on test or production this will enable the package
    | To choose whether to consume sandbox or live
    | 
    |
    */


    "environment"=>env("PAYPAL_ENVIRONMENT")


];