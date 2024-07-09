<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => config('auth.roles.admin')]);
        $worker = Role::create(['name' => config('auth.roles.worker')]);
        $user = Role::create(['name' => config('auth.roles.user')]);
        $trainer = Role::create(['name' => config('auth.roles.trainer')]);
        $physiotherapist = Role::create(['name' => config('auth.roles.physiotherapist')]);
        $dietician = Role::create(['name' => config('auth.roles.dietician')]);

    }
}
