<?php

namespace App\Providers;

use App\Services\Cart\CartService;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('CartService', function() {
            return new CartService();
        });
    }
}
