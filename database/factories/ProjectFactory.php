<?php

namespace Database\Factories;

use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => 'project_'.fake()->unique()->word(),
            'status' => fake()->boolean() ? Project::STATUS_ACTIVE : Project::STATUS_DISABLED,
        ];
    }
}
