<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class TrainerSeeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/trainers.csv"), 'r');

$firstLine = true;
while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
if (!$firstLine) {
    $trainer = Trainer::create(
    [
        "imie" => $data['0'],
        "nazwisko" => $data['1'],
        "opis" => $data['2'],
        "image" => $data['4'],
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
    $trainer->save();
    print($data['3']);
    $specializationsIds = $data['3']->toArray();
    if($specializationsIds && $trainer)
    $trainer->specializations()->sync($specializationsIds);
    $trainer->save();
    }
    $firstLine = false;
    }

    fclose($csvFile);
        }
}
