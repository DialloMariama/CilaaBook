<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Porteurprojet>
 */
class PorteurprojetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'telephone' => fake()->phoneNumber(),
            'adresse' => fake()->address(),


            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',

        ];
    }
}
