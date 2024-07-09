<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use LaravelViews\Views\DetailView;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Events\Actions\DeleteEventAction;
use App\Http\Livewire\Events\Actions\SignOffFromEventDetailAction;


class EventDetailView extends DetailView
{
    public $model = Event::class;
    public $user;
   
    /**
     * @param $model Model instance
     * @return Array Array with all the detail data or the components
     */


    public function render()
    {
        return view('livewire.events.event-show');
    }

    public function actions()
    {
        return[
            new DeleteEventAction,
            new SignOffFromEventDetailAction,
        ];
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

}
