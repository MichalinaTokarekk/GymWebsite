<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    protected $faker;

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
        //otworzenie pliku csv i przypisanie go do zmiennej
        $csvFile = fopen(base_path("database/data/activities.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                //pobranie z bazy danych id trenera (losowo)
                $query = User::query()->select('id')
                ->whereHas('roles', function($q){
                    $q->where('name','trainer');
                })
                ->orderByRaw('RAND()')
                ->first()
                ->id;
                //tworzenie zajęć
                Activity::create(
                [
                    "name" => $data['0'],
                    "description" => $data['1'],
                    "image" => $data['2'],
                    'trainer_id' => $query,
                    'created_at' => $this->faker->dateTimeBetween(
                    '- 8 weeks',
                    '- 4 weeks',
                    ),
                    'updated_at' => $this->faker->dateTimeBetween(
                    '- 4 weeks',
                    '- 1 week'
                    ),
                    'deleted_at' => null,
                 ]);
 
            }
        $firstLine = false;
     }
 //zamknięcie pliku csv
     fclose($csvFile);
         }
    }
