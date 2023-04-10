<?php

namespace Database\Factories;

use Faker\Provider\id_ID\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => fake()->name(),
          'address' => fake()->address(),
          'phone' => '081'.fake()->randomNumber(9, true)
        ];
    }
}
