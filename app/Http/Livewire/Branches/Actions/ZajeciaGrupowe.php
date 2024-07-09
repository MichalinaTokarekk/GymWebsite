<?php

namespace App\Http\Livewire\Branches\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ZajeciaGrupowe extends Action
{

    public $title = '';
    public $icon = 'users';
    public function __construct()
    {
        parent::__construct();
        $this->title = __('branches.actions.zajeciagrupowe');
    }

    
    public function handle($models)
    {
       
    }


 
}
