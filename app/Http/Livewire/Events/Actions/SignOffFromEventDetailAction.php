<?php

namespace App\Http\Livewire\Events\Actions;

use App\Models\Event;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Confirmable;

class SignOffFromEventDetailAction extends Action
{
    use Confirmable;
    public $title = '';
    // public $icon = 'trash-2';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.sign_off');
    }

    public function getConfirmationMessage($model)
    {
        return  __('events.dialogs.sign_off_event.description', [
            'title' => $model->title
        ]);
        // return 'Czy na pewno chcesz usunąć wydarzenie '.$model->title.' ???';
    }

    public function handle($model, View $view)
    {
        $user = Auth::user();
                //Zmniejszenie wartosci "current_participants" o 1
        if($model->current_participants > 0){
            $currentParticipantsValue = $model->current_participants - 1;
            $model->update(['current_participants' => $currentParticipantsValue]); //Aktualizacja kolumny 'current_participants'
           
        }  
        $user->events()->detach($model);
        return redirect()->route('events.myEvents', $user);
        // $view->dialog()->confirm([
        //     'title' => __('events.dialogs.sign_off_event.title'),
        //     'description' => __('events.dialogs.sign_off_event.description', [
        //         'title' => $model->title
        //     ]),
        //     'icon' => 'question',
        //     'iconColor' => 'text-red-500',
        //     'accept' => [
        //         'label' => __('translation.yes'),
        //         'method' => 'decline',
        //         'params' => $model->id,
        //     ],
        //     'reject' => [
        //         'label' => __('translation.no'),
        //     ]
        //     ]);
    }

    public function renderIf($model, View $view)
    {
        return true;
    }

     


}
