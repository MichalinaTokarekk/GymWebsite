<?php

namespace App\Policies;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('trainers.index');
    }

    public function manage(User $user)
    {
        return $user->can('trainers.manage');
    }

    public function create(User $user)
    {
        return $user->can('trainers.manage');
    }

    public function update(User $user, Trainer $trainer)
    {
        return $trainer->deleted_at === null
        &&      $user->can('trainers.manage');
    }

    
    public function delete(User $user, Trainer $trainer)
    {
        return $trainer->deleted_at === null
        &&      $user->can('trainers.manage');
    }

  
    public function restore(User $user, Trainer $trainer)
    {
        return $trainer->deleted_at !== null
        &&      $user->can('trainers.manage');
    }

    public function show(User $user)
    {
        return $user->can('trainers.index');
    }
}
