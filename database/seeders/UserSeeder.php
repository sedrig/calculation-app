<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Kostyantin', 'phone' => '+380 (111) 11-11-11', 'password' => Hash::make('Rjcnjuhsp2001'), 'is_admin' => '1', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Vladislav', 'phone' => '+380 (222) 22-22-22', 'password' => Hash::make('Rjcnjuhsp2001'), 'is_admin' => '0', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ]);
    }
}
