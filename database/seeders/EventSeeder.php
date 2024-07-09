<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Faker\Generator;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/events.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                //pobranie z bazy danych id trenera (losowo)
                $queryTrainer = User::query()->select('id')
                ->whereHas('roles', function($q){
                    $q->where('name','trainer');
                })
                ->orderByRaw('RAND()')
                ->first()
                ->id;
                
                $queryActivity = Activity::query()->select('id')
                ->orderByRaw('RAND()')
                ->first()
                ->id;
                //tworzenie zajęć
                $event = Event::create(
                [
                    "title" => $data['0'],
                    "description" => $data['1'],
                    // "image" => $data['2'],
                    'trainer_id' => $queryTrainer,
                    'activity_id' => $queryActivity,
                    'max_participants' => $data['2'],
                    'start' => $data['3'],
                    'end' => $data['4'],
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
                 $event->save();
 
            }
        $firstLine = false;
     }
 //zamknięcie pliku csv
     fclose($csvFile);
         }
    }
