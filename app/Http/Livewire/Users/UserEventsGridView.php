<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\Event;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Users\Actions\SignOffFromEventAction;

class UserEventsGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Event::class;

    protected $paginate = 20;
    public $maxCols = 1;

    public $cardComponent = 'livewire.events.grid-view-item';

    public $searchBy = [
        'title',
    ];

    public function repository():Builder
    {
        $userId = request()->user()->id;
        $events = Event::whereHas ('users', function($query) use ($userId){
            $query->where('user_id', $userId);
        })->get();
       
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
            return [
                new SignOffFromEventAction(),
            ];
    }

    public function signOffUser($modelId)
    {
        $this->executeAction('sign-off-from-event-action', $modelId);
    }

    public function decline($modelId)
    { 
        $model = Event::find($modelId);
        // $this->authorize('decline', $model);
        $user = Auth::user();

                //Zmniejszenie wartosci "current_participants" o 1
        if($model->current_participants > 0){
            $currentParticipantsValue = $model->current_participants - 1;
            $model->update(['current_participants' => $currentParticipantsValue]); //Aktualizacja kolumny 'current_participants'
           
        }  
        $user->events()->detach($model);
        return redirect()->route('events.myEvents', $user);
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
