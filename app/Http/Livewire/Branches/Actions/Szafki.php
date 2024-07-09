<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class Szafki extends Action
{
    public $title = '';
    public $icon = 'key';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.szafki');
    }

    
    public function handle($models)
    {
       
    }
}
