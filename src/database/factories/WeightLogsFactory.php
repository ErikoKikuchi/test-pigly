<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WeightLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y/m/d'),
            'weight' => $this->faker->randomFloat(1, 50, 60),
            'calories' => $this->faker->numberBetween(15, 30)*100,
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->sentence(120),
        ];
    }
}
