# Paypal Server  Intergration With Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epmnzava/paypal-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/pesapal)
[![Build Status](https://img.shields.io/travis/epmnzava/paypal-laravel/master.svg?style=flat-square)](https://travis-ci.org/epmnzava/pesapal)
[![Total Downloads](https://img.shields.io/packagist/dt/epmnzava/paypal-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/pesapal)
[![Emmanuel Mnzava](https://img.shields.io/badge/Author-Emmanuel%20Mnzava-green)](mailto:epmnzava@gmail.com)


This package is meant to help laravel developers to easily integrate their server side web application or web service with pa
[Paypal ] (https://developer.paypal.com/docs/archive/checkout/how-to/server-integration/)

![alt text](https://github.com/dbrax/paypal-laravel/blob/main/src/assets/paypal_server.png)


## Installation

- Laravel Version: => 7.1
- PHP Version: => 7.1

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
use Paypal;
class TestController extends Controller
{
    



    public function simplepay_by_paypal(){



$response=Paypal::CreatePayment("5","0","0","1","Payment for basket ball");


    $payment_id=$response["order_id"];



return redirect($response["checkout_link"]);







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

