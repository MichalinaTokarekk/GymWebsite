<?php

namespace App\Http\Livewire\Updates\Actions;

use App\Http\Livewire\Actions\RestoreAction;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class RestoreUpdateAction extends RestoreAction
{
    protected function dialogTitle(): String
    {
        return __('updates.dialogs.restore.title');
    }

    protected function dialogDescription(Model $model): String 
    {
        return __('updates.dialogs.restore.description', [
            'title' => $model->title,
        ]);
    }
   
}
