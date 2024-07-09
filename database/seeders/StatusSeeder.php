<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dodaj nowy rekord do tabeli 'status' z polem 'name' ustawionym na 'OCZEKIWANE'
        DB::table('status')->insert([
           [ 'name' => 'OCZEKIWANE',],
           ['name' => 'W TRAKCIE'],
           ['name' => 'ZAKOŃCZONE']
        ]);
    }
}
