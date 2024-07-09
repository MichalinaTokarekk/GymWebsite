<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
        return $user->can('events.manage');
    }

    public function update(User $user, Event $event)
    {
        return $event->deleted_at === null
            && $user->can('events.manage');
    }

    public function delete(User $user, Event $event)
    {
        return $event->deleted_at === null
            && $user->can('events.manage');
    }

    public function restore(User $user, Event $event)
    {
        return $event->deleted_at !== null
            && $user->can('events.manage');
    }

    public function manage(User $user)
    {
        return $user->can('events.manage');
    }

    public function sign(User $user)
    {
        return $user->can('events.sign');
    }

    public function canAttaching(User $user, Event $event) : bool
    {
        return !$user->events()->where('event_id', $event->id)->exists();
    }
}
