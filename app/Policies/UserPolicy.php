<?php

namespace App\Policies;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('users.index');
    }

    public function manage(User $user)
    {
        return $user->can('users.manage');
    }

    public function create(User $user)
    {
        return $user->can('users.manage');
    }

    public function update(User $user, User $user2)
    {
        return $user2->deleted_at === null
        &&      $user->can('users.manage');
    }

    
    public function delete(User $user, User $user2)
    {
        return $user2->deleted_at === null
        &&      $user->can('users.manage');
    }

  
    public function restore(User $user, User $user2)
    {
        return $user2->deleted_at !== null
        &&      $user->can('users.manage');
    }

    public function show(User $user)
    {
        return $user->can('users.index');
    }
}


