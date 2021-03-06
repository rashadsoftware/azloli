<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run()
    {
        DB::table('banners')->insert([
            [
            'banner_image'      =>  'default.jpg',
            'banner_title'      =>  'Loli ilə artıq istənilən sahə üzrə işçi tapmaq çox asandır',
            'banner_position'   =>  'left',
            'banner_subtitle'   =>  'Bu platforma ilə artıq bütün işçilər qapınızdadır'],
        ]);
    }
}
