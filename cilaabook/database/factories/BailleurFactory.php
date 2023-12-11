<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bailleur>
 */
class BailleurFactory extends Factory
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
            'statut' => 'personne',



            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',


        ];
    }
}
