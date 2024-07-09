<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeleteAction;

class SoftDeleteTrainerAction extends SoftDeleteAction
{
    protected function dialogTitle(): String
    {
        return __('trainers.dialogs.soft_delete.title');
    }

    protected function dialogDescription(Model $model): String
    {
        return __('trainers.dialogs.soft_delete.description', [
            'imie' => $model->imie, 
            'nazwisko' => $model->nazwisko
        ]);
    }
}

