<?php

namespace App\Http\Livewire\Activities;

use App\Models\User;
use App\Models\Activity;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Activities\Actions\EditActivityAction;
use App\Http\Livewire\Activities\Actions\RestoreActivityAction;
use App\Http\Livewire\Activities\Actions\SoftDeleteActivityAction;


class ActivitiesGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Activity::class;

    protected $paginate = 20;
    public $maxCols = 2;

    public $searchBy = [
        'title'
        
    ];
    public $cardComponent = 'livewire.activities.grid-view-item';
    public function repository():Builder
    {

        $query = Activity::query(); 
            if (request()->user() !== null && request()->user()->can('manage', Activity::class)){
                $query->withTrashed();
            }
            return $query;
    }
   
    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'title' => $model->name,
            'description' => $model->description,
            'user' => User::find($model->trainer_id),
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }

    protected function actionsByRow()
    {
       if (request()->user() !== null && request()->user()->can('manage', Activity::class)) {
        return [
            new EditActivityAction('activities.edit', __('translation.actions.edit')
        ),
            new SoftDeleteActivityAction(),
            new RestoreActivityAction(),

        ];
       } else {
        return [];
       }
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('activities.messages.successes.destroy', [
            'name' => $model->name,

        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('activities.messages.successes.restore', [
            'name' => $model->name,
        ]);
    }


}
