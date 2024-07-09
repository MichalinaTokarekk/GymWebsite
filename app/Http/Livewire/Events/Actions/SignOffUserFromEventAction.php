<?php

namespace App\Http\Livewire\Events\Actions;

use App\Models\Event;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class SignOffUserFromEventAction extends Action
{
    public $title = '';
    public $icon = 'log-out';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.sign_off');
    }

    public function handle($model, View $view)
    {
        $name = $model->imie.' '.$model->nazwisko;
        $event = $view->event;
        $view->dialog()->confirm([
            'title' => __('events.dialogs.sign_off_event.user.title'),
            'description' => __('events.dialogs.sign_off_event.user.description', [
                'name' => $name,
                'title' => $event->title
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'removeUser',
                'params' => $model->id,
                    
                    
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
            ]);
    }

    public function renderIf($model, View $view)
    {
        return  Auth::user()->can('manage', Event::class);
    }

     


}
