<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', 'now')->format('Y-m-d');
        $end = $this->faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d');

        return [
            'project_id' => Project::factory(),
            'reporter_id' => User::factory(),
            'assignee_id' => User::factory(),
            'code' => strtoupper($this->faker->unique()->bothify('ISSUE-###')),
            'title' => ucfirst($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['open', 'in_progress', 'closed']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_window' => ['start' => $start, 'end' => $end], 
        ];
    }
}
