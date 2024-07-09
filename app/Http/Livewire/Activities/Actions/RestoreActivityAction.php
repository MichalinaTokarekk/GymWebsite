<?php

namespace App\Http\Livewire\Activities\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreActivityAction extends Action
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
            'title' => __('activities.dialogs.restore.title'),
            'description' => __('activities.dialogs.restore.description', [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-gree-500',
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

    public function renderIf($model, View $view)
    {
        return request()->user()->can('restore', $model);
    }
 
}
