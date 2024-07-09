<?php

namespace Database\Factories;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    
   public function definition()
   {
        $query = User::query()->select('id')
            ->whereHas('roles', function($q){
                $q->where('name','trainer');
            })
            ->orderByRaw('RAND()')
            ->first()
            ->id;
       return [
           'title' => $this->faker->title(100),
           'description' => $this->faker->text(300),
           'date' => $this->faker->date("Y_m_d"),
           'trainer_id' => $query,
           'created_at' => $this->faker->dateTimeBetween(
               '- 8 weeks',
               '- 4 weeks',
           ),
           'updated_at' => $this->faker->dateTimeBetween(
               '-4 weeks',
               '- 1 weeks',
           ),
           'deleted_at' => rand(0, 10) === 0
               ? $this->faker->dateTimeBetween(
                       '- 1 week',
                       '+ 2 weeks',
               )
               : null
       ];
   }
}
