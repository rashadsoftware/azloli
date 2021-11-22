<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('configs')->insert([
            'config_title' => 'Loli.az',
            'config_logo' => '',
            'config_favicon' => '',
            'config_phone' => '0605450075',
            'config_phone2' => '',
            'config_phone3' => '',
            'config_address' => 'Abşeron ray, Heydər Əliyev prospetki',
            'config_shortdescription' => '',
            'config_description' => 'Biz XM Group olaraq 6 Noyabr 2021-ci il tarixindən fəaliyyətə başladıq. Şirkətimiz müştərilərimizə yeni iş imkanları  təmin edir, eyni zamanda işçi axtaranlarada eyni xidmətləri sunur. Bizim platforma etibarlı, güvənli və istifadəsi rahat xidmətlər təklif edir. Biz XM group olaraq Azərbaycan xalqına xidmət göstərməkdən məmnunuq!',
            'config_email' => 'info@loli.az',
            'config_email2' => '',
            'config_facebook' => '',
            'config_instagram' => '',
            'config_whatsapp' => '',
            'config_youtube' => '',
            'config_video_rolik' => '',
        ]);
    }
}
