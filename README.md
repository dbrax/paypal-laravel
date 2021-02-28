# Paypal Server  Intergration With Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epmnzava/paypal-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/pesapal)
[![Build Status](https://img.shields.io/travis/epmnzava/paypal-laravel/master.svg?style=flat-square)](https://travis-ci.org/epmnzava/pesapal)
[![Total Downloads](https://img.shields.io/packagist/dt/epmnzava/paypal-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/pesapal)
[![Emmanuel Mnzava](https://img.shields.io/badge/Author-Emmanuel%20Mnzava-green)](mailto:epmnzava@gmail.com)


This package is meant to help laravel developers to easily integrate their server side web application or web service with pa
[Paypal ] (https://developer.paypal.com/docs/archive/checkout/how-to/server-integration/)

![alt text](https://github.com/dbrax/paypal-laravel/blob/main/src/assets/paypal_server.png)


## Installation

## Version Matrix

Version | Laravel   | PHP Version
------- | --------- | ------------
1.5     | 8.0       | >= 8.0
1.3     | 8.0       | >= 7.3
1.2     | 7.0       | >= 7.2.5

You can install the package via composer:

```bash
composer require epmnzava/paypal-laravel
```

# Update your config (for Laravel 5.4 and below)
Add the service provider to the providers array in config/app.php:

```
"Epmnzava\PaypalLaravel\PaypalLaravelServiceProvider"::class
```

Add the facade to the aliases array in config/app.php:

```
'Paypal'=>Epmnzava\PaypalLaravel\PaypalLaravelFacade::class,
```

# Publish the package configuration (for Laravel 5.4 and below)
Publish the configuration file and migrations by running the provided console command:
```
php artisan vendor:publish --provider="Epmnzava\PaypalLaravel\PaypalLaravelServiceProvider"
```

### Environmental Variables
PAYPAL_CLIENT_ID ` your provided paypal client id  `<br/>

PAYPAL_CLIENT_SECRET ` your provided paypal client secret `<br/>

PAYPAL_REDIRECT_URL    ` your  redirect url `<br/>

PAYPAL_CANCEL_URL    ` your  cancel url `<br/>

PAYPAL_ENVIRONMENT  ` your  environment either test or production  `<br/>

PAYPAL_CURRENCY_CODE ` currency put TZS for Tanzanian Shillings `<br/>

PAYPAL_ORG_NAME `your organization name`<br/>

## Usage

``` php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Epmnzava\PaypalLaravel\PaypalLaravel as Paypal;
class TestController extends Controller
{
    



    public function payments(){



$paypal_payments=new paypal;      
$response=$paypal_payments->CreatePayment(int $amount, $tax, $shipping, $handling_fee, $description);

// You will need the order_id to reference the transaction hence save it from here.
$payment_id=$response["order_id"]; 


//the checkout link will lead the user  you to paypal  where he/she can approve the payment.
return redirect($response["checkout_link"]);
    }


```
# After payment approval the user will be redirected back to your application on  PAYPAL_REDIRECT_URL which you have set on your .env

``` php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Epmnzava\PaypalLaravel\PaypalLaravel as Paypal;
class TestController extends Controller
{
    


    public function paypal_redirect(Request $request){
      $paypal=new Paypal;

      // This will execute the approved payment notice that the redirected url comes back with PayerID which we reuse it
      $response=$paypal->executePayment($request->paymentId,$request->PayerID);

      if(json_decode($response)->state=="approved"){
// update your database and share the success message to the user.
      }



    }


```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email epmnzava@gmail.com instead of using the issue tracker.

## Credits

- [Emmanuel Mnzava](https://github.com/epmnzava)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

