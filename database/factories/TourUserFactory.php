<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourUser>
 */
class TourUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tour_id' => $this->faker->numberBetween(1, 30),
            'user_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
