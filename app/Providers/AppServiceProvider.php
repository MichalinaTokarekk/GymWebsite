<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Livewire\Cart\CartStep;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\Cart\DeliveryStep;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Cart\ConfirmOrderStep;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
        Livewire::component('cart-step', CartStep::class);
        Livewire::component('delivery-step', DeliveryStep::class);
        Livewire::component('confirm-order-step', ConfirmOrderStep::class);

        Validator::extend('numeric_decimal', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\d+(\.\d{1,2})?$/', $value);
        });

    }
}
