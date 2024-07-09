<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreUserAction extends Action
{
    public $title = '';
    public $icon = 'trash';


    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.restore');
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('users.dialogs.restore.title'),
            'description' => __('users.dialogs.restore.description', [
                'imie' => $model->imie,
                'nazwisko' => $model->nazwisko
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'restore',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
            ]);
    }

    public function renderIF($model, View $view)
    {
        return $model->deleted_at !== null;
    }
}
