<?php

namespace Epmnzava\PaypalLaravel\Tests;

use Orchestra\Testbench\TestCase;
use Epmnzava\PaypalLaravel\PaypalLaravelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [PaypalLaravelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
