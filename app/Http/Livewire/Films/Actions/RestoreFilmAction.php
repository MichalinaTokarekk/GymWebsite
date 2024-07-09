<?php

namespace App\Http\Livewire\Films\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\RestoreAction;

class RestoreFilmAction extends RestoreAction
{


    protected function dialogTitle(): String
    {
        return __('films.dialogs.restore.title');
    }

    protected function dialogDescription(Model $model): String 
    {
        return __('films.dialogs.restore.description', [
            'title' => $model->title,
    
        ]);
    }
}
