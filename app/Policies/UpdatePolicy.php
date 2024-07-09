<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Update;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpdatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('updates.index');
    }

    public function manage(User $user)
    {
        return $user->can('updates.manage');
    }

    public function create(User $user)
    {
        return $user->can('updates.manage');
    }

    public function update(User $user, Update $trainer)
    {
        return $trainer->deleted_at === null
        &&      $user->can('updates.manage');
    }

    
    public function delete(User $user, Update $trainer)
    {
        return $trainer->deleted_at === null
        &&      $user->can('updates.manage');
    }

  
    public function restore(User $user, Update $trainer)
    {
        return $trainer->deleted_at !== null
        &&      $user->can('updates.manage');
    }

    public function show(User $user)
    {
        return $user->can('updates.index');
    }
}
