<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;


class AssignTrainerRoleAction extends Action
{

    public $title = '';
    public $icon = 'cloud';
    
    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.assign_trainer_role');
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('users.dialogs.assign_role.title'),
            'description' => __('users.dialogs.assign_role.trainer', [
                'imie' => $model->imie,
                'nazwisko' => $model->nazwisko
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'assignTrainerRole',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
            ]);
    }
    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.trainer'))
            && $model->deleted_at === null;
    }
}
