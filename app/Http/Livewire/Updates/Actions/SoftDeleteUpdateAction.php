<?php

namespace App\Http\Livewire\Updates\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeleteAction;

class SoftDeleteUpdateAction extends SoftDeleteAction
{
    protected function dialogTitle(): String
    {
        return __('updates.dialogs.soft_delete.title');
    }

    protected function dialogDescription(Model $model): String
    {
        return __('updates.dialogs.soft_delete.description', [
            'title' => $model->title,
        ]);
    }
}

