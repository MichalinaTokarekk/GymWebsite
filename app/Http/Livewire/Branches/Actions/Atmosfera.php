<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class Atmosfera  extends Action
{
    public $title = '';
    public $icon = 'heart';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.atmosfera');

        
    }

    
    public function handle($models)
    {
       
    }
}
