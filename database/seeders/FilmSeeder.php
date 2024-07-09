<?php

namespace Database\Seeders;

use App\Models\Film;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class FilmSeeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/films.csv"), 'r');

$firstLine = true;
while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
if (!$firstLine) {
    Film::create(
    [
        "title" => $data['0'],
        "description" => $data['1'],
        "video" => $data['2'],
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
