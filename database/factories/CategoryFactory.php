<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'description' => $this->faker->sentence(6),
            'parent_id' => null,
            'created_by' => 1,
        ];
    }
}
