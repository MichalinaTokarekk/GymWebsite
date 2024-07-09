<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class SoftDeleteUserAction extends Action
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
            'title' => __('users.dialogs.soft_delete.title'),
            'description' => __('users.dialogs.soft_delete.description', [
                'imie' => $model->imie,
                'nazwisko' => $model->nazwisko
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
        return $model->deleted_at === null
            && Auth::user()->id!==$model->id;
    }

}
