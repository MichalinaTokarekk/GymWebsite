<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class Sauna extends Action
{
    public $title = '';
    public $icon = 'star';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.sauna');
    }

    
    public function handle($models)
    {
       
    }
}
