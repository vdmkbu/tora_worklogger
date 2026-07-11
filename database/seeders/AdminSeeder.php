<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position_id = DB::table('positions')->insertGetId([
            'name' => 'admin',
            'status' => 'active',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.loc',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'status' => 'active',
            'position_id' => $position_id,
        ]);
    }
}
