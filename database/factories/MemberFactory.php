<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'summary' => $this->faker->text(200), // Generate a random summary of about 200 characters
            'ds_division' => $this->faker->randomElement(['Colombo 1', 'Colombo 2', 'Colombo 3']),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = '2002-12-31', $min = '1992-01-01'),
        ];
    }
}
