<?php

namespace App\Http\Livewire\Traits;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait CompetitionSign
{
    protected function competitionSaveNotificationTitle()
    {
        return __('translation.messages.successes.destroy_title');
    }

    protected function competitionSaveNotificationDescription(Model $model)
    {
        return __('translation.messages.successes.destroy_description', [
            'model' => $model
        ]);
    }

    public function competitionSave(int $id, Competition $competition)
    {
        $model = $this->model::find($id);
        $model->competitions()->syncWithoutDetaching($competition);
        $this->notification()->success(
            $title = $this->softDeleteNotificationTitle(),
            $description = $this->softDeleteNotificationDescription($model)
        );
    }

}
