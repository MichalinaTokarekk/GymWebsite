<?php

namespace Database\Seeders;

use App\Models\Update;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Storage;

class UpdateSeeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/updates.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                Update::create(
                [
                    "title" => $data['0'],
                    "description" => $data['1'],
                    "image" => $data['3'],
                    'created_at' => $data['2']. ' ' .$this->faker->time(),
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
