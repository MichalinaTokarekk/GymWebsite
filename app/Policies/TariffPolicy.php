<?php

namespace App\Policies;

use App\Models\Tariff;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TariffPolicy
{

    use HandlesAuthorization;


    public function manage(User $user)
    {
        return $user->can('tariffs.manage');
    }

    public function create(User $user)
    {
        return $user->can('tariffs.manage');
    }

    public function update(User $user, Tariff $tariff)
    {
        return $tariff->deleted_at === null
        &&      $user->can('tariffs.manage');
    }

    
    public function delete(User $user, Tariff $tariff)
    {
        return $tariff->deleted_at === null
        &&      $user->can('tariffs.manage');
    }

  
    public function restore(User $user, Tariff $tariff)
    {
        return $tariff->deleted_at !== null
        &&      $user->can('tariffs.manage');
    }

    
}
