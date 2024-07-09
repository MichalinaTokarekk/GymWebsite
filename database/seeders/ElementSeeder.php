<?php

namespace Database\Seeders;

use App\Models\Element;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class ElementSeeder extends Seeder
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
                $csvFile = fopen(base_path("database/data/elements.csv"), 'r');
        
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 100, ',')) !== FALSE) {
        if (!$firstLine) {
        Element::create(
        [
        "name" => $data['0'],
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
        
        fclose($csvFile);
            }
 
    }
