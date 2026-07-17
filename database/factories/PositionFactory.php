<?php

namespace Database\Factories;

use App\Modules\Position\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Position>
 */
class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition(): array
    {
        return [
            'name' => 'position_'.fake()->unique()->word(),
            'status' => fake()->boolean() ? Position::STATUS_ACTIVE : Position::STATUS_DISABLED,
        ];
    }
}
