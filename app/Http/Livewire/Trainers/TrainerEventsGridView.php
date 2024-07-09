<?php

namespace App\Http\Livewire\Trainers;

use App\Models\User;
use App\Models\Event;
use WireUi\Traits\Actions;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;

class TrainerEventsGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Event::class;

    protected $paginate = 20;
    public $maxCols = 1;

    public $cardComponent = 'livewire.events.trainer-grid-view-item';

    public $searchBy = [
        'title',
    ];

    public function repository():Builder
    {
        $trainerId = request()->user()->id;
        $events = Event::where ('trainer_id', $trainerId)
            ->where('end', '>=', Carbon::now())
            ->get();
        $eventsIds = $events->pluck('id')->toArray();
        $query = Event::query()->whereIn('id', $eventsIds);
                 
        return $query;
    }
   
    public function card($model)
    {
        return [
            'title' => $model->title,
            'description' => $model->description,
            'start' => $model->start,
            'end' => $model->end,
            'user' => User::find($model->trainer_id),
        ];
    
    }
    
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }



    protected function actionsByRow()
    {
        // if (request()->user()->can('manage', Activity::class)) {
        //     return [
        //         new EditActivityAction('activities.edit', __('translation.actions.edit')
        //     ),
        //         new SoftDeleteActivityAction(),
        //         new RestoreActivityAction(),
    
        //     ];
        //    } else {
        //     return [];
        //    }
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
