<?php

namespace Database\Seeders;

use App\Modules\Position\Models\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory()->count(10)->create();
    }
}
