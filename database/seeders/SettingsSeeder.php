<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(['id' => 1], [
            'brand_name' => 'VIP Ketering',
            'tagline' => 'Let us do all the work',
            'logo' => '/img/logo-vip.png',
            'phone_primary' => '078 226 005',
            'phone_primary_label' => 'Димитар',
            'phone_secondary' => '078 410 416',
            'phone_secondary_label' => 'Мартин',
            'email' => 'vipketering@yahoo.com',
            'address' => 'Скопје 1000, Македонија',
            'facebook_url' => 'https://www.facebook.com/vipketering',
            'instagram_url' => 'https://www.instagram.com/vipketering',
        ]);
    }
}
