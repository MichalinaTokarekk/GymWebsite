<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
// class ActivityFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'name' => $this->faker->text(8),
//             'description' => $this->faker->text(120),
//             'created_at' => $this->faker->dateTimeBetween(
//                 '- 8 weeks',
//                 '- 4 weeks',
//             ),
//             'updated_at' => $this->faker->dateTimeBetween(
//                 '-4 weeks',
//                 '- 1 weeks',
//             ),
//             'deleted_at' => rand(0, 10) === 0
//                 ? $this->faker->dateTimeBetween(
//                         '- 1 week',
//                         '+ 2 weeks',
//                 )
//                 : null
//         ];
//     }
// }
