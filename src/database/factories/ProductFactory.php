<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(100, 10000),
            'image_path' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence,
            
        ];
    }
}
