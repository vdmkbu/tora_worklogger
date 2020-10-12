<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'status' => 'active'
        ];

        $position_id = DB::table('positions')->insertGetId($data);

        $data = [
          'name' => 'admin',
          'email' => 'admin@admin.loc',
          'password' => bcrypt('admin'),
          'role' => 'admin',
          'status' => 'active',
          'position_id' => $position_id
        ];

        DB::table('users')->insert($data);
    }
}
