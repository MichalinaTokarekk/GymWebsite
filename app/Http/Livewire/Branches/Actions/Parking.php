<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class Parking extends Action
{
    public $title = '';
    public $icon = 'truck';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.parking');
    }

    
    public function handle($models)
    {
       
    }
}
