<?php

namespace App\Policies;

use App\Models\Specialization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecializationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        
        return $user->can('specializations.index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('specializations.manage');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Specialization $specialization)
    {
        return $specialization->deleted_at === null
            && $user->can('specializations.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Specialization $specialization)
    {
        return $specialization->deleted_at === null
            && $user->can('specializations.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Specialization $specialization)
    {
        return $specialization->deleted_at !== null
            && $user->can('specializations.manage');
    }

}
