<?php

namespace App\Http\Livewire\Users\Actions;

use App\Http\Livewire\Actions\RestoreAction;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class RestoreTrainerAction extends RestoreAction
{
    protected function dialogTitle(): String
    {
        return __('trainers.dialogs.restore.title');
    }

    protected function dialogDescription(Model $model): String 
    {
        return __('trainers.dialogs.restore.description', [
            'imie' => $model->imie,
            'nazwisko' => $model->nazwisko,


        ]);
    }
   
}
