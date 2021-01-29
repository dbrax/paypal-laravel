<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Email: epmnzava@gmail.com
 * Github:https://github.com/dbrax/paypal-laravel
 * 
 */

namespace Epmnzava\PaypalLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\PaypalLaravel\Skeleton\SkeletonClass
 */
class PaypalLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'paypal-laravel';
    }
}
