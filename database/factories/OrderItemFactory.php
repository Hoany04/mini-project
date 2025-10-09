<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => rand(1, 10),
            'product_id' => rand(1, 20),
            'variant_id' => null,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(100000, 800000),
        ];
    }
}
