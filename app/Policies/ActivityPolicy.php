<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        
        return $user->can('activities.index');
        // return true;
    }

    public function create(User $user)
    {
        return $user->can('activities.manage');

    }

    public function update(User $user, Activity $activity)
    {
        return $activity->deleted_at === null
            && $user->can('activities.manage');
    }

    public function delete(User $user, Activity $activity)
    {
        return $activity->deleted_at === null
            && $user->can('activities.manage');
    }

    public function restore(User $user, Activity $activity)
    {
        return $activity->deleted_at !== null
            && $user->can('activities.manage');
    }

    public function manage(User $user)
    {
        return $user->can('activities.manage');
    }
}
