<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FullCalenderPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
        return $user->can('events.manage');
    }

    public function manage(User $user)
    {
        return $user->can('events.manage');
    }
}
