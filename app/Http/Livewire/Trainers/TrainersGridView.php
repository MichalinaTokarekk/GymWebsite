<?php

namespace App\Http\Livewire\Trainers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Trainers\CadreGridView;


class TrainersGridView extends CadreGridView
{
    public function repository():Builder
    {
        $query = User::query()->whereHas('roles', function($q){
            $q->where('name','trainer');
        })
        ->with(['specializations']);
            if (request()->user() !== null && request()->user()->can('manage', User::class)){
                $query->withTrashed();
            }
        return $query;
    }

}
