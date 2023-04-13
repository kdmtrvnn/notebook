<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'surname' => $this->faker->name(),
            'name' => $this->faker->name(),
            'patronymic' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'campaign' => Str::random(6),
            'phone' => Str::random(6),
            'date_of_birth' => Str::random(6),
        ];
    }
}
