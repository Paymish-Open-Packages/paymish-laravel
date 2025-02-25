<?php

namespace Paymish\Facades;

use Illuminate\Support\Facades\Facade;

class Paymish extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymish';
    }
}
