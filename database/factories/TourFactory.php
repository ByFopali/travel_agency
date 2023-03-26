<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(1, 1500),
            'description' => $this->faker->text(100),
            'image' => $this->faker->word . '.png',
            'place_id' => $this->faker->numberBetween(1, 35),
            'discount_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
