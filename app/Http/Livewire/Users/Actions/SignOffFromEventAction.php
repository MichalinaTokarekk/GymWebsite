<?php

namespace App\Http\Livewire\Users\Actions;

use App\Models\Event;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class SignOffFromEventAction extends Action
{
    public $title = '';
    // public $icon = 'trash-2';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.sign_off');
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('events.dialogs.sign_off_event.title'),
            'description' => __('events.dialogs.sign_off_event.description', [
                'title' => $model->title
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'decline',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
            ]);
    }

    public function renderIf($model, View $view)
    {
        return true;
    }

     


}
