<?php

namespace App\Http\Livewire\Tariffs\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreTariffAction extends Action
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
            'title' => __('tariffs.dialogs.restore.title'),
            'description' => __('tariffs.dialogs.restore.description', [
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
        if(request()->user() !== null){
            return request()->user()->can('restore', $model);
        }
        
    }
}
