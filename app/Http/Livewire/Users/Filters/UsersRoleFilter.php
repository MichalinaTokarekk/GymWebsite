<?php

namespace App\Http\Livewire\Users\Filters;

use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UsersRoleFilter extends Filter
{

    public $title='';

    public function __construct()
    {
        parent::__construct();
        $this->title=__('users.attributes.roles');
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('roles', function(Builder $query) use($value) {
            $query->where('id','=',$value);
        });
    }

    public function options(): Array
    {
        $roles = Role::all();
        $labes = $roles->pluck('name');
        $value = $roles->pluck('id');
        return $labes->combine($value)->toArray();
    }

}

