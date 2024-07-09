<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Tariff;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class TariffSeeder  extends Seeder
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
        $csvFile = fopen(base_path("database/data/tariffs.csv"), 'r');

$firstLine = true;
while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
if (!$firstLine) {
    Tariff::create(
    [
        "name" => $data['0'],
        "type" => $data['1'],
        "number" => $data['2'],
        "price" => $data['3'],
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
