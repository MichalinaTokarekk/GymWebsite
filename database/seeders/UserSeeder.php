<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use App\Models\Trainer;
use Illuminate\Container\Container;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    protected $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function __construct()
     {
        $this->faker = $this->withFaker();
     }

     protected function withFaker()
     {
        return Container::getInstance()->make(Generator::class);
     }

    public function run()
    {
        //ADMINISTRATORZY
        $csvFile = fopen(base_path("database/data/admins.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                $admin = User::create(
                    [
                        "imie" => $data['0'],
                        "nazwisko" => $data['1'],
                        "email" => $data['2'],
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make('12345678'),
                    ]);
                $adminRole = Role::findByName(config('auth.roles.admin'));
                if (isset($adminRole)) {
                    $admin->assignRole($adminRole);
                    $admin->save();
                }
            }
            $firstLine = false;
        }
        fclose($csvFile);
       
        //PRACOWNIK
        $worker =  User::create([
            'imie' => 'Pracownik Test',
            'nazwisko' => 'W',
            'email' => 'pracownik.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        
        $workerRole = Role::findByName(config('auth.roles.worker'));
        if (isset($workerRole)) {
            $worker->assignRole($workerRole);
        }

        //UZYTKOWNIK
        $user = User::create([
            'imie' => 'User Test',
            'nazwisko' => 'U',
            'email' => 'user.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);

        $userRole = Role::findByName(config('auth.roles.user'));
        if (isset($userRole)) {
            $user->assignRole($userRole);
        }
    
        //TRENER
        $trainer = User::create([
            'imie' => 'Trener Test',
            'nazwisko' => 'T',
            'email' => 'trener.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'deleted_at' => $this->faker->dateTimeBetween(
                '- 6 weeks',
                '- 3 week'
            )
        ]);
        $trainerRole = Role::findByName(config('auth.roles.trainer'));
        if (isset($trainerRole)) {
            $trainer->assignRole($trainerRole);
        }

        //TRZENERZY
        $csvFile = fopen(base_path("database/data/trainers.csv"), 'r');

        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                    $trainer = User::create(
                    [
                        "imie" => $data['0'],
                        "nazwisko" => $data['1'],
                        "opis" => $data['2'],
                        "image" => $data['4'],
                        'password' => Hash::make('12345678'),
                        'email' => strtolower($data['0']).'.'.strtolower($data['1']) . '@localhost',
                        'email_verified_at' => Carbon::now(),
                        'created_at' => $this->faker->dateTimeBetween(
                        '- 8 weeks',
                        '- 4 weeks',
                        ),
                        'updated_at' => $this->faker->dateTimeBetween(
                        '- 4 weeks',
                        '- 1 week'
                        ),
                        'deleted_at' => null,
                    ])->assignRole(config('auth.roles.trainer'));
                    $trainer->save();
                    $specializations = array_map('intval',explode(',', $data['3']));
                    $specializationsIds = collect($specializations)->toArray();
                    if($specializationsIds && $trainer) {
                        $trainer->specializations()->sync($specializationsIds);
                        $trainer->save();
                    }
                }
            $firstLine = false;
        }
        fclose($csvFile);

        //FIZJOTERAPEUTA
        $physiotherapist = User::create([
            'imie' => 'Fizjo Test',
            'nazwisko' => 'F',
            'email' => 'fizjo.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);

        $physiotherapistRole = Role::findByName(config('auth.roles.physiotherapist'));
        if (isset($physiotherapistRole)) {
            $physiotherapist->assignRole($physiotherapistRole);
        }


        //FIZJOTERAPEUCI
        $csvFile = fopen(base_path("database/data/physiotherapists.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                $physiotherapist = User::create(
                [
                    "imie" => $data['0'],
                    "nazwisko" => $data['1'],
                    "opis" => $data['2'],
                    'password' => Hash::make('12345678'),
                    'email' => strtolower($data['0']).'.'.strtolower($data['1']) . '@localhost',
                    'email_verified_at' => Carbon::now(),
                    'created_at' => $this->faker->dateTimeBetween(
                    '- 8 weeks',
                    '- 4 weeks',
                    ),
                    'updated_at' => $this->faker->dateTimeBetween(
                    '- 4 weeks',
                    '- 1 week'
                    ),
                    'deleted_at' => null,
                ])->assignRole(config('auth.roles.physiotherapist'));
                $physiotherapist->save();
                $specializations = array_map('intval',explode(',', $data['3']));
                $specializationsIds = collect($specializations)->toArray();
                if($specializationsIds && $physiotherapist) {
                    $physiotherapist->specializations()->sync($specializationsIds);
                    $physiotherapist->save();
                }
            }
            $firstLine = false;
        }
        fclose($csvFile);
 
     
        //DIETETYK
        $dietician = User::create([
            'imie' => 'Dietetyk Test',
            'nazwisko' => 'D',
            'email' => 'dietetyk.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        $dieticianRole = Role::findByName(config('auth.roles.dietician'));
        if (isset($dieticianRole)) {
        $dietician->assignRole($dieticianRole);
        }
        //DIETETYCY
        
        $csvFile = fopen(base_path("database/data/dieticians.csv"), 'r');

        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                $dietician = User::create(
                [
                    "imie" => $data['0'],
                    "nazwisko" => $data['1'],
                    "opis" => $data['2'],
                    "image" => $data['3'],
                    'password' => Hash::make('12345678'),
                    'email' => strtolower($data['0']).'.'.strtolower($data['1']) . '@localhost',
                    'email_verified_at' => Carbon::now(),
                    'created_at' => $this->faker->dateTimeBetween(
                    '- 8 weeks',
                    '- 4 weeks',
                    ),
                    'updated_at' => $this->faker->dateTimeBetween(
                    '- 4 weeks',
                    '- 1 week'
                    ),
                    'deleted_at' => null,
                ])->assignRole(config('auth.roles.dietician'));
                $dietician->save();
                    $specializations = array_map('intval',explode(',', $data['3']));
                    $specializationsIds = collect($specializations)->toArray();
                    if($specializationsIds && $dietician) {
                        $dietician->specializations()->sync($specializationsIds);
                        $dietician->save();
                    }
            }
            $firstLine = false;
        }
        
        fclose($csvFile);

    }
}