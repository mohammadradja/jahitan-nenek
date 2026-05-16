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
            // General
            ['key' => 'site_name', 'value' => 'Jahitan Nenek', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Rajutan Kasih Sayang dari Tangan Nenek', 'type' => 'string', 'group' => 'general'],
            ['key' => 'transaction_mode', 'value' => 'dev', 'type' => 'string', 'group' => 'general'], // dev or prod

            // Midtrans
            ['key' => 'midtrans_server_key', 'value' => 'SB-Mid-server-XXXXX', 'type' => 'string', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_client_key', 'value' => 'SB-Mid-client-XXXXX', 'type' => 'string', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_is_production', 'value' => '0', 'type' => 'boolean', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_base_url', 'value' => 'https://app.sandbox.midtrans.com/snap/v1', 'type' => 'string', 'group' => 'payment_midtrans'],
            
            // Logistics
            ['key' => 'rajaongkir_api_key', 'value' => 'b2bkQDirfd22cfcb6cbb92f0vZMnyocN', 'type' => 'string', 'group' => 'logistics'],
            ['key' => 'rajaongkir_origin_city', 'value' => '153', 'type' => 'string', 'group' => 'logistics'], // Jakarta Selatan
            ['key' => 'rajaongkir_base_url', 'value' => 'https://api.rajaongkir.com/starter', 'type' => 'string', 'group' => 'logistics'],
            ['key' => 'rajaongkir_type', 'value' => 'starter', 'type' => 'string', 'group' => 'logistics'], // starter, basic, pro
            ['key' => 'rajaongkir_couriers', 'value' => 'jne,tiki,pos', 'type' => 'string', 'group' => 'logistics'],

            // QRISLY
            ['key' => 'qrisly_api_key', 'value' => 'lBbgOXjEfd22cfcb6cbb92f0bxeqco2O', 'type' => 'string', 'group' => 'payment_qrisly'],
            ['key' => 'qrisly_merchant_id', 'value' => 'M12345', 'type' => 'string', 'group' => 'payment_qrisly'],
            ['key' => 'qrisly_base_url', 'value' => 'https://api.qrisly.id/v1', 'type' => 'string', 'group' => 'payment_qrisly'],

            // WhatsApp (Fonnte)
            ['key' => 'whatsapp_number', 'value' => '628123456789', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_api_token', 'value' => 'dummy_token', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_base_url', 'value' => 'https://api.fonnte.com/send', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'notifications'],

            // Mail / SMTP
            ['key' => 'mail_from_address', 'value' => 'hello@jahitannenek.com', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_from_name', 'value' => 'Jahitan Nenek', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_port', 'value' => '2525', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'string', 'group' => 'mail'],
            
            // Localization
            ['key' => 'default_language', 'value' => 'id', 'type' => 'string', 'group' => 'localization'],
            ['key' => 'available_languages', 'value' => 'id,en', 'type' => 'string', 'group' => 'localization'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
