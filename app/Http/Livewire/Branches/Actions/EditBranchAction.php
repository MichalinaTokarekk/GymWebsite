<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\RedirectAction;

class EditBranchAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'edit')
    {
        parent::__construct($to, $title, $icon);
    }
    
    public function renderIf($model, View $view) 
    {
        if(request()->user()!==null)
        return request()->user()->can('update', $model);
        return '';
    }
        

}