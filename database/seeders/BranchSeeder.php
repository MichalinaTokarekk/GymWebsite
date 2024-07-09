<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class BranchSeeder extends Seeder
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
                $csvFile = fopen(base_path("database/data/branches.csv"), 'r');
        
        $firstLine = true;
        while(($data = fgetcsv($csvFile, 300, ';')) !== FALSE) {
        if (!$firstLine) {
            $branch = Branch::create(
            [
                "place" => $data['0'],
                "name" => $data['1'],
                "address" => $data['2'],
                "phone" => $data['3'],
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

            $branch->save();                      
            $elementsArray = explode(',',$data['4']);
            $elementsIds = array_map('intval',$elementsArray);
            if($elementsIds && $branch)
            $branch->elements()->sync($elementsIds);
            $branch->save();
            
            }
        $firstLine = false;
        }
        
        fclose($csvFile);
    }
}
