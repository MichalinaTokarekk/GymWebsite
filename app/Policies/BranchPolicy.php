<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        
        return $user->can('branches.index');
    }

    public function create(User $user)
    {
        return $user->can('branches.manage');

    }
    public function update(User $user, Branch $branch)
    {
        return $branch->deleted_at === null
            && $user->can('branches.manage');
    }


    public function delete(User $user, Branch $branch)
    {
        return $branch->deleted_at === null
            && $user->can('branches.manage');
    }

    
}
