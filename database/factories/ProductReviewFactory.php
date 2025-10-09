<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 20),
            'user_id' => rand(3, 10),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(10),
            'created_at' => now(),
        ];
    }
}
