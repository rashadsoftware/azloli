<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    public function run()
    {
        DB::table('datas')->insert([
            ['data_key' => 'first_title',
            'data_value' => '',
            'data_cat' => 'mission'],

            ['data_key' => 'second_title',
            'data_value' => '',
            'data_cat' => 'mission'],

            ['data_key' => 'third_title',
            'data_value' => '',
            'data_cat' => 'mission'],

            ['data_key' => 'mission',
            'data_value' => '',
            'data_cat' => 'image'],

            ['data_key' => 'offer',
            'data_value' => '',
            'data_cat' => 'image'],
        ]);
    }
}
