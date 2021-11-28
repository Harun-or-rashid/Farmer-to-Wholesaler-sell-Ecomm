<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'type' => 'admin',
            'role' => 'admin',
            'username' => 'admin',
            'mobile' => '01700000000',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'first_name' => 'Alexander',
            'last_name' => 'Pierce',
            'status' => 1,
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'deleted' => 0
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'type' => 'customer',
            'role' => 'customer',
            'username' => 'customer',
            'mobile' => '01700005005',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('123456'),
            'first_name' => 'Allaia',
            'last_name' => 'Customer',
            'status' => 1,
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'deleted' => 0
        ]);
    }
}
