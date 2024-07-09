<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class WiFi extends Action
{
    public $title = '';
    public $icon = 'wifi';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.wifi');
    }

    
    public function handle($models)
    {
       
    }
}
