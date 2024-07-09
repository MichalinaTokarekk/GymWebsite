<?php

namespace App\Http\Livewire\Trainers;

use App\Models\User;
use App\Models\Trainer;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Trainers\CadreGridView;
use App\Http\Livewire\Users\Actions\EditTrainerAction;
use App\Http\Livewire\Users\Actions\RestoreUserAction;
use App\Http\Livewire\Users\Actions\RestoreTrainerAction;
use App\Http\Livewire\Users\Actions\SoftDeleteUserAction;
use App\Http\Livewire\Users\Actions\SoftDeleteTrainerAction;

class DieticiansGridView extends CadreGridView
{
    public function repository():Builder
    {
        $query = User::query()->whereHas('roles', function($q){
            $q->where('name','dietician');
        })
        ->with(['specializations']);
            if (request()->user() !== null && request()->user()->can('manage', User::class)){
                $query->withTrashed();
            }
        
        return $query;
    }
   

}
