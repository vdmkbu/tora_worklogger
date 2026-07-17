<?php

namespace Database\Seeders;

use App\Modules\Log\Models\Log;
use App\Modules\Project\Models\Project;
use App\Modules\User\Models\User;
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
