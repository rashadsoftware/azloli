<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['user_name' => 'Rəşad Ələkbərov',
            'user_image' => '',
            'user_email' => 'rashadalakbarov2020@gmail.com',
            'user_password' => Hash::make('qasimov24123'),
            'user_status' => 'admin',
            'user_address' => '',
            'user_phone' => '',
            'user_state' => 'active',
			'user_publish' => '',
			'user_activate' => '',
            'user_description' => '',
            'user_ip' => '127.0.0.1'],

            ['user_name' => 'Xalid',
            'user_image' => '',
            'user_email' => 'xalid@gmail.com',
            'user_password' => Hash::make('123456'),
            'user_status' => 'admin',
			'user_address' => '',
            'user_phone' => '',
            'user_state' => 'active',
            'user_publish' => '',
            'user_activate' => '',
            'user_description' => '',
            'user_ip' => '127.0.0.1']
        ]);
    }
}
