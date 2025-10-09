<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(3, 10),
            'coupon_id' => null,
            'total_amount' => $this->faker->numberBetween(150000, 2000000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'shipped', 'completed']),
        ];
    }
}
