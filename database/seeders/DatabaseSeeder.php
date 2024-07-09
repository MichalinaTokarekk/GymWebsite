<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Update;
use App\Models\Competition;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Database\Seeders\FilmSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ShopSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BranchSeeder;
use Database\Seeders\TariffSeeder;
use Database\Seeders\ElementSeeder;
use Database\Seeders\TrainerSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\CompetitionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StatusSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ActivitySeeder::class);
        // $this->call(TrainerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CompetitionSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(UpdateSeeder::class);
        $this->call(TariffSeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(ElementSeeder::class);









        User::factory(10)->create();




    }
}
