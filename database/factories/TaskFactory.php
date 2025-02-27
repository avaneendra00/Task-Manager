<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->sentence(),
            'deskripsi' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'completed']),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id
        ];
    }
}
