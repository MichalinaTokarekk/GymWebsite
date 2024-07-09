<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CartService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CartService';
    }

}

