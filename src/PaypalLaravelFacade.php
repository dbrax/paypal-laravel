<?php

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
