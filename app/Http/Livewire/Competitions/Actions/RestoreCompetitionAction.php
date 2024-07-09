<?php

namespace App\Http\Livewire\Competitions\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\RestoreAction;

class RestoreCompetitionAction extends RestoreAction
{


    protected function dialogTitle(): String
    {
        return __('competitions.dialogs.restore.title');
    }

    protected function dialogDescription(Model $model): String 
    {
        return __('competitions.dialogs.restore.description', [
            'title' => $model->title,
    
        ]);
    }
}
