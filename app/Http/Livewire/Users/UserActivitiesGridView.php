<?php

namespace App\Http\Livewire\Users;

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



class UserActivitiesGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Activity::class;

    protected $paginate = 15;
    public $maxCols = 1;
    public $searchBy = [
        'title',
    ];
    public $cardComponent = 'livewire.activities.grid-view-item';

    public function repository():Builder
    {
        
        $activities = request()->user()->with('activities')->get()->pluck('activities')->flatten();  
        $list = [];
        foreach ($activities as $activity) {
            $list[] = $activity->id;
              
        } 
        
        $query = Activity::query()
                ->whereIn('id', $list);
                 
        return $query;
    }
   
    public function card($model)
    {
        return [
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
        if (request()->user()->can('manage', Activity::class)) {
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
        return __('competitions.messages.successes.destroy', [
            'title' => $model->title

        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('competitions.messages.successes.restore', [
            'title' => $model->title

        ]);
    }
}
