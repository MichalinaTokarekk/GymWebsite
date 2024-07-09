<?php

namespace Database\Seeders;

use App\Models\Shop;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Storage;

class ShopSeeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/shops.csv"), 'r');
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 50000, ';')) !== FALSE) {
            if (!$firstLine) {
                Shop::create(
                [
                    "title" => $data['0'],
                    "link" => $data['1'],
                    "description" => $data['2'],
                    "image" => $data['3'],
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
