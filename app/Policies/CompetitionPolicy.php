<?php

namespace App\Policies;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
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
        return $user->can('competitions.index');
    }


    public function manage(User $user)
    {
        return $user->can('competitions.manage');
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('competitions.manage');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Competition $competition)
    {
        return $competition->deleted_at === null
            && $user->can('competitions.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Competition $competition)
    {
        return $competition->deleted_at === null
            && $user->can('competitions.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Competition $competition)
    {
        return $competition->deleted_at !== null
            && $user->can('competitions.manage');
    }

    public function show(User $user)
    {
        return $user->can('competitions.index');
    }

    public function record(User $user)
    {
        return $user->can('competitions.index');
    }

    public function canAttaching(User $user, Competition $competition) : bool
    {
        return !$user->competitions()->where('competition_id', $competition->id)->exists();
    }

}
