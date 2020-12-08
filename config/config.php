<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    "sandbox_endpoint"=>"https://api-m.sandbox.paypal.com",

    "live_endpoint"=>"https://api-m.paypal.com",

    "client_id"=>env("PAYPAL_CLIENT_ID"),

    "client_secret"=>env("PAYPAL_CLIENT_SECRET"),

    "environment"=>env("PAYPAL_ENVIRONMENT")

];