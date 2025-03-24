<?php

namespace database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'user_id' => 1,
            'price' => $this->faker->randomFloat(2, 100, 500),
            'duration' => $this->faker->numberBetween(3, 10),
            'category_id' => null,
            'status' => 'activo',
        ];
    }
}
