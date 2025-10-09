<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(3, true)),
            'category_id' => rand(1, 5),
            'user_id' => 2, // Seller
            'price' => $this->faker->numberBetween(100000, 800000),
            'stock' => $this->faker->numberBetween(10, 50),
            'sold' => $this->faker->numberBetween(0, 20),
            'description' => $this->faker->paragraph(),
            'status' => 'active',
            'average_rating' => $this->faker->randomFloat(2, 3, 5),
            'total_review' => $this->faker->numberBetween(0, 100),
        ];
    }
}
