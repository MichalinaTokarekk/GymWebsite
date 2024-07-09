<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use App\Models\Trainer;
use App\Models\Category;
use App\Models\Competition;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class CompetitionSeeder extends Seeder
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
        $categories = Category::all();
        // Competition::factory()
        //     ->count(50)
        //     ->create()
        //     ->each(function ($competition) use ($categories) {
        //         $competition->categories()->attach(
        //             $categories->random(rand(1, 3))
        //                 ->pluck('id')
        //                 ->toArray()
        //         );
        //     });
        
        //otworzenie pliku csv i przypisanie go do zmiennej
        $csvFile = fopen(base_path("database/data/competitions.csv"), 'r');
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

                //tworzenie zawodów
                $tmp = Competition::create(
                [
                    "title" => $data['0'],
                    "description" => $data['1'],
                    "date" => $data['2'],
                    "image" => $data['3'],
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

                $kategorieTmp = explode(",", $data['4']);
                $kategorie = collect();
                foreach($kategorieTmp as $kat)
                {
                    $znalezionaKategoria = $categories->where('id',$kat)->first();

                    if($znalezionaKategoria){
                        $kategorie->push($znalezionaKategoria->id);
                    }
                       
                    
                }
                $tmp->categories()->attach($kategorie);
                $tmp->save();
                
            }
            $firstLine = false;
        }
        //zamknięcie pliku csv
         fclose($csvFile);
    }
}
