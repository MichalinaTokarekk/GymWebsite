<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PERMISSIONS -------------------------------------------------------
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // USER -------------------------------------------------------
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.manage']);
        Permission::create(['name' => 'users.change_role']);
        // TRAINER -------------------------------------------------------
        Permission::create(['name' => 'trainers.manage']);
        Permission::create(['name' => 'trainers.index']);
        // CATEGORIES -------------------------------------------------------
        Permission::create(['name' => 'categories.manage']);
        Permission::create(['name' => 'categories.index']);
        // COMPETITIONS -------------------------------------------------------
        Permission::create(['name' => 'competitions.manage']);
        Permission::create(['name' => 'competitions.index']);
        // UPDATES -------------------------------------------------------
        Permission::create(['name' => 'updates.manage']);
        Permission::create(['name' => 'updates.index']);
        // ACTIVITIES -------------------------------------------------------
        Permission::create(['name' => 'activities.manage']);
        Permission::create(['name' => 'activities.index']);
        // DIETICIAN -------------------------------------------------------
        Permission::create(['name' => 'dietician.manage']);
        Permission::create(['name' => 'dietician.index']);
        // PHYSIOTHERAPIST -------------------------------------------------------
        Permission::create(['name' => 'physiotherapist.manage']);
        Permission::create(['name' => 'physiotherapist.index']);
        // SPECIALIZATIONS -------------------------------------------------------
        Permission::create(['name' => 'specializations.manage']);
        Permission::create(['name' => 'specializations.index']);
        // SHOPS -------------------------------------------------------
        Permission::create(['name' => 'shops.manage']);
        Permission::create(['name' => 'shops.index']);
        // TARIFFS -------------------------------------------------------
        Permission::create(['name' => 'tariffs.manage']);
        Permission::create(['name' => 'tariffs.index']);
        // EVENTS -------------------------------------------------------
        Permission::create(['name' => 'events.manage']);
        Permission::create(['name' => 'events.index']);
        Permission::create(['name' => 'events.sign']);
        // FILMS -------------------------------------------------------
        Permission::create(['name' => 'films.manage']);
        Permission::create(['name' => 'films.index']);
        // BRANCHES ----------------------------------------------------
        Permission::create(['name' => 'branches.index']);  
        Permission::create(['name' => 'branches.manage']);  


        // PRZYPISANIE ROLI POD ZMIENNĄ-------------------------------------------------------
        $adminRole = Role::findByName(config('auth.roles.admin'));
        $workerRole = Role::findByName(config('auth.roles.worker'));
        $trainerRole = Role::findByName(config('auth.roles.trainer'));
        $userRole = Role::findByName(config('auth.roles.user'));

        // NADANIE PERMISJI ADMINOWI -------------------------------------------------------
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.manage');
        $adminRole->givePermissionTo('users.change_role');
        $adminRole->givePermissionTo('trainers.manage');
        $adminRole->givePermissionTo('trainers.index');  
        $adminRole->givePermissionTo('categories.manage');
        $adminRole->givePermissionTo('competitions.index'); 
        $adminRole->givePermissionTo('competitions.manage'); 
        $adminRole->givePermissionTo('updates.manage');
        $adminRole->givePermissionTo('updates.index');  
        $adminRole->givePermissionTo('activities.index'); 
        $adminRole->givePermissionTo('activities.manage'); 
        $adminRole->givePermissionTo('dietician.index'); 
        $adminRole->givePermissionTo('dietician.manage'); 
        $adminRole->givePermissionTo('physiotherapist.index'); 
        $adminRole->givePermissionTo('physiotherapist.manage'); 
        $adminRole->givePermissionTo('specializations.index'); 
        $adminRole->givePermissionTo('specializations.manage'); 
        $adminRole->givePermissionTo('shops.index'); 
        $adminRole->givePermissionTo('shops.manage'); 
        $adminRole->givePermissionTo('tariffs.index'); 
        $adminRole->givePermissionTo('tariffs.manage'); 
        $adminRole->givePermissionTo('events.index'); 
        $adminRole->givePermissionTo('events.manage'); 
        $adminRole->givePermissionTo('events.sign'); 
        $adminRole->givePermissionTo('films.index'); 
        $adminRole->givePermissionTo('films.manage');
        $adminRole->givePermissionTo('branches.index'); 
        $adminRole->givePermissionTo('branches.manage'); 


        
        // NADANIE PERMISJI WORKEROWI -------------------------------------------------------
        $workerRole->givePermissionTo('trainers.index');
        $workerRole->givePermissionTo('updates.index');  
        $workerRole->givePermissionTo('categories.index');
        $workerRole->givePermissionTo('competitions.index');
        $workerRole->givePermissionTo('activities.index');
        $workerRole->givePermissionTo('shops.index');
        $workerRole->givePermissionTo('shops.manage'); 

        $workerRole->givePermissionTo('films.index');

        $workerRole->givePermissionTo('tariffs.index');
        $workerRole->givePermissionTo('events.index');
        $workerRole->givePermissionTo('events.manage');
        $workerRole->givePermissionTo('events.sign');
        $workerRole->givePermissionTo('branches.index'); 
        $workerRole->givePermissionTo('updates.manage');

        
        
        
        // NADANIE PERMISJI TRENEROWI -------------------------------------------------------
        $trainerRole->givePermissionTo('trainers.index');
        $trainerRole->givePermissionTo('trainers.manage');
        $trainerRole->givePermissionTo('updates.index');  
        $trainerRole->givePermissionTo('categories.index');
        $trainerRole->givePermissionTo('competitions.index');
        $trainerRole->givePermissionTo('competitions.manage');
        $trainerRole->givePermissionTo('activities.index');
        $trainerRole->givePermissionTo('activities.manage'); 
        $trainerRole->givePermissionTo('shops.index');
        $trainerRole->givePermissionTo('films.index');
        $trainerRole->givePermissionTo('tariffs.index');
        $trainerRole->givePermissionTo('events.index');
        $trainerRole->givePermissionTo('events.manage');
        $trainerRole->givePermissionTo('events.sign');
        $trainerRole->givePermissionTo('branches.index');
        $trainerRole->givePermissionTo('branches.manage');

        $trainerRole->givePermissionTo('updates.manage');

        
        
        // NADANIE PERMISJI USEROWI -------------------------------------------------------
        $userRole->givePermissionTo('trainers.index');
        $userRole->givePermissionTo('updates.index');  
        $userRole->givePermissionTo('categories.index');
        $userRole->givePermissionTo('competitions.index');
        $userRole->givePermissionTo('activities.index');
        $userRole->givePermissionTo('shops.index');
        $userRole->givePermissionTo('films.index');
        $userRole->givePermissionTo('tariffs.index');
        $userRole->givePermissionTo('events.index');
        $userRole->givePermissionTo('events.sign');
        $userRole->givePermissionTo('branches.index');


    }
}
