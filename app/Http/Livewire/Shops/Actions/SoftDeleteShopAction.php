<?php

namespace App\Http\Livewire\Shops\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeleteAction;

class SoftDeleteShopAction extends SoftDeleteAction
{

    protected function dialogTitle(): String
    {
        return __('shops.dialogs.soft_delete.title');
    }

    protected function dialogDescription(Model $model): String
    {
        return __('shops.dialogs.soft_delete.description', [
            'title' => $model->title
        ]);
    }

}
