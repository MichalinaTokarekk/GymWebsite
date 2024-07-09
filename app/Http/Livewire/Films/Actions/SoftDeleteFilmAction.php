<?php

namespace App\Http\Livewire\Films\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Actions\SoftDeleteAction;

class SoftDeleteFilmAction extends SoftDeleteAction
{

    protected function dialogTitle(): String
    {
        return __('films.dialogs.soft_delete.title');
    }

    protected function dialogDescription(Model $model): String
    {
        return __('films.dialogs.soft_delete.description', [
            'title' => $model->title
        ]);
    }

}
