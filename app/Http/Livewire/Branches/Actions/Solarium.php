<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Actions\Action;

class Solarium extends Action
{
    public $title = '';
    public $icon = 'sun';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.solarium');
    }

    
    public function handle($models)
    {
       
    }
}
