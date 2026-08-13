<?php

declare(strict_types=1);

namespace Zitro\Parameters\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Zitro\Parameters\ParametersServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ParametersServiceProvider::class,
        ];
    }
}
