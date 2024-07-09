<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;

trait Restore
{
        protected function restoreNotificationTitle()
        {
            return __('translation.messages.successes.restore_title');
        }

        protected function restoreNotificationDescription(Model $model)
        {
            return __('translation.messages.successes.restore_description', [
                'model' => $model
            ]);
        }

        public function restore(int $id)
        {
            $model = $this->model::withTrashed()->find($id);
            $model->restore();
            $this->notification()->success(
                $title = $this->restoreNotificationTitle(),
                $description = $this->restoreNotificationDescription($model)
            );
        }
}