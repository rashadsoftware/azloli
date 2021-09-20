<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('configs')->insert([
            'config_title' => 'Expert',
            'config_logo' => '',
            'config_favicon' => '',
            'config_phone' => '0558515673',
            'config_address' => 'Abşeron ray, Heydər Əliyev prospetki',
            'config_description' => 'Usta Arıyorum devri kapandı, Ustabak.com devri başladı. Ustabak, Türkiye genelinde mesleğinde iyi olan tüm profesyonellerin biraraya geldiği hizmet platformudur. Lokasyonunuzu belirleyin ve en yakın ustalardan, yapılacak işinize teklifleri toplayın. En uygun teklifi veren ustaya işi verin.',
            'config_email' => 'info@expert.com',
            'config_facebook' => '',
            'config_instagram' => '',
        ]);
    }
}
