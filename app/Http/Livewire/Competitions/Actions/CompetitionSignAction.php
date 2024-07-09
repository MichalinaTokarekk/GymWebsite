<?php

namespace App\Http\Livewire\Competitions\Actions;

use Illuminate\Database\Eloquent\Model;

class CompetitionSignAction
{
    protected function dialogTitle(): String
    {
        return __('competitions.dialogs.soft_delete.title');
    }

    protected function dialogDescription(Model $model): String
    {
        return __('competitions.dialogs.soft_delete.description', [
            'title' => $model->title
        ]);
    }
}
