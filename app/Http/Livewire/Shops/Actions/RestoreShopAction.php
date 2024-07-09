<?php

namespace App\Http\Livewire\Shops\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\RestoreAction;

class RestoreShopAction extends RestoreAction
{


    protected function dialogTitle(): String
    {
        return __('shops.dialogs.restore.title');
    }

    protected function dialogDescription(Model $model): String 
    {
        return __('shops.dialogs.restore.description', [
            'title' => $model->title,
    
        ]);
    }
}
