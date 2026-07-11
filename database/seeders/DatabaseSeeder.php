<?php

namespace Database\Seeders;

use App\Log;
use App\Project;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(PositionsTableSeeder::class);

        User::factory()->count(10)->create();
        Project::factory()->count(20)->create();
        Log::factory()->count(100)->create();
    }
}
