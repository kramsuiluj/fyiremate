<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inspector>
 */
class InspectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rank' => $this->faker->title,
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastname,
            'lastname' => $this->faker->lastName
        ];
    }
}
