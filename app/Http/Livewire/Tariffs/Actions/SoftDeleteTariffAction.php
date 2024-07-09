<?php

namespace App\Http\Livewire\Tariffs\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class SoftDeleteTariffAction extends Action 
{
    public $title = '';
    public $icon = 'trash-2';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.destroy');
    }
    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('tariffs.dialogs.soft_delete.title'),
            'description' => __('tariffs.dialogs.soft_delete.description', [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'softDelete',
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
            return request()->user()->can('delete', $model);
        }
        
    }
}
