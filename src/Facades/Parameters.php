<?php

declare(strict_types=1);

namespace Zitro\Parameters\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zitro\Parameters\Parameters
 */
class Parameters extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Zitro\Parameters\Parameters::class;
    }
}
