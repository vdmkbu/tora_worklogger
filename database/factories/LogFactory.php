<?php

namespace Database\Factories;

use App\Log;
use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Log>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-7 days');

        return [
            'project_id' => Project::active()->inRandomOrder()->value('id'),
            'text' => fake()->text(rand(20, 40)),
            'link' => fake()->url(),
            'user_id' => User::active()->inRandomOrder()->value('id'),
            'time' => rand(1, 8),
            'date' => $createdAt->format('Y-m-d'),
        ];
    }
}
