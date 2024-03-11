<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
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
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'priority' => $this->faker->numberBetween(1, 3), // Random number between 1 and 3
            'user_id' => User::inRandomOrder()->first()->id, // Random user ID
            'project_id' => Project::inRandomOrder()->first()->id, // Random project ID
        ];
    }
}