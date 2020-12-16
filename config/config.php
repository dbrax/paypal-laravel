<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    "sandbox_endpoint"=>"https://api-m.sandbox.paypal.com",

    "live_endpoint"=>"https://api-m.paypal.com",

    "client_id"=>env("PAYPAL_CLIENT_ID"),

    "client_secret"=>env("PAYPAL_CLIENT_SECRET"),

    "org_name"=>env("PAYPAL_ORG_NAME"),

    "return_url"=>env("PAYPAL_REDIRECT_URL"),
    
    "cancel_url"=>env("PAYPAL_CANCEL_URL"),


    "currency_code"=>env("PAYPAL_CURRENCY_CODE"),

    "environment"=>env("PAYPAL_ENVIRONMENT")


];