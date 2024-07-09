<?php

namespace App\Http\Livewire\Activities;

use App\Models\Activity;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Activities\Filters\SoftDeleteFilter;
use App\Http\Livewire\Activities\Actions\EditActivityAction;
use App\Http\Livewire\Activities\Actions\RestoreActivityAction;
use App\Http\Livewire\Activities\Actions\SoftDeleteActivityAction;




class ActivitiesTableView extends TableView
{
    use Actions;
    use SoftDelete;
    use Restore;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;


    
    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function repository():Builder
    {
        return Activity::query()->withTrashed();
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('activities.attributes.name'))->sortBy('name'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->description,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters(){
        return [
            new SoftDeleteFilter,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditActivityAction('activities.edit', __('translation.actions.edit')),
            new SoftDeleteActivityAction(),
            new RestoreActivityAction(),
        ];
    }

    public function softDelete(int $id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroy_title'),
            $description = __('activities.messages.successes.destroy', [
                'name' => $activity->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $activity = Activity::withTrashed()->find($id);
        $activity->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restore_title'),
            $description = __('activities.messages.successes.restore', [
                'name' => $activity->name,
            ]),
        );
    }
}
