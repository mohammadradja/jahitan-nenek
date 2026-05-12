<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Jahitan Nenek', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Premium Handmade Knitwear from Local Artisans', 'type' => 'text', 'group' => 'general'],
            
            // Payment Settings (Midtrans)
            ['key' => 'midtrans_server_key', 'value' => 'SB-Mid-server-XXXXX', 'type' => 'string', 'group' => 'payment'],
            ['key' => 'midtrans_client_key', 'value' => 'SB-Mid-client-XXXXX', 'type' => 'string', 'group' => 'payment'],
            ['key' => 'midtrans_is_production', 'value' => false, 'type' => 'boolean', 'group' => 'payment'],
            
            // SEO Settings
            ['key' => 'meta_keywords', 'value' => 'knitwear, handmade, fashion, artisanal, sweaters', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => 'UA-XXXXX-Y', 'type' => 'string', 'group' => 'marketing'],
            ['key' => 'facebook_pixel_id', 'value' => '1234567890', 'type' => 'string', 'group' => 'marketing'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::set($setting['key'], $setting['value'], $setting['type'], $setting['group']);
        }
    }
}
