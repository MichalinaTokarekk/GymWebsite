<?php

namespace App\Http\Livewire\Tariffs\Actions;

use App\Facades\CartService;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;


class AddToCartAction extends Action
{
    public $title = '';
    public $icon = 'shopping-cart';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('tariffs.actions.add_to_cart');
    }

    

    public function handle($model, View $view)
    {
        if(request()->user() !== null){
            CartService::add($model->id);
            $view->notification()->success(
                $title = __('translation.messages.successes.cart_title'),
                $description = __(
                    'tariffs.messages.successes.added_to_cart',
                    ['name' => $model->name]
                )
            );
            $view->emit('cartUpdated');
        }else{
            $view->notification()->success(
                $title = __('translation.messages.login'),
                $description = __(
                    'tariffs.messages.successes.login'
                )
            );
        }

    }
}
