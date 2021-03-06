<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(PositionsTableSeeder::class);
        factory(\App\User::class, 10)->create();
        factory(\App\Project::class, 20)->create();
        factory(\App\Log::class, 100)->create();
    }
}
