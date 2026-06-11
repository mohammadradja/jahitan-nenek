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
            ['key' => 'site_tagline', 'value' => 'Rajutan Kasih Sayang Premium', 'type' => 'string', 'group' => 'general'],
            ['key' => 'transaction_mode', 'value' => 'dev', 'type' => 'string', 'group' => 'general'], // dev or prod
            ['key' => 'promo_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'promo'],
            ['key' => 'promo_label', 'value' => 'Promo Spesial', 'type' => 'string', 'group' => 'promo'],
            ['key' => 'promo_original_price', 'value' => '150000', 'type' => 'integer', 'group' => 'promo'],
            ['key' => 'promo_real_price', 'value' => '100000', 'type' => 'integer', 'group' => 'promo'],
            ['key' => 'promo_description', 'value' => 'Harga spesial untuk koleksi pilihan Jahitan Nenek.', 'type' => 'string', 'group' => 'promo'],

            // Midtrans
            ['key' => 'midtrans_server_key', 'value' => 'SB-Mid-server-XXXXX', 'type' => 'string', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_client_key', 'value' => 'SB-Mid-client-XXXXX', 'type' => 'string', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_is_production', 'value' => '0', 'type' => 'boolean', 'group' => 'payment_midtrans'],
            ['key' => 'midtrans_base_url', 'value' => 'https://app.sandbox.midtrans.com/snap/v1', 'type' => 'string', 'group' => 'payment_midtrans'],

            // Bank Transfer & Flat Shipping
            ['key' => 'bank_transfer_info', 'value' => "BCA: 713-152-9329 a/n Risma Ayu Anggraini\nMANDIRI: 987-654-3210 a/n Jahitan Nenek", 'type' => 'string', 'group' => 'payment_bank'],
            ['key' => 'flat_shipping_cost', 'value' => '15000', 'type' => 'integer', 'group' => 'logistics'],
            
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
            ['key' => 'whatsapp_number', 'value' => '62-888-9288-083', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_api_token', 'value' => 'dummy_token', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_base_url', 'value' => 'https://wa.me/qr/ULW3DK6V5AYDC1', 'type' => 'string', 'group' => 'notifications'],
            ['key' => 'whatsapp_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'notifications'],

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

            // Brand Assets
            ['key' => 'site_logo', 'value' => 'assets/logo.png', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'site_favicon', 'value' => 'favicon.ico', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_instagram_url', 'value' => 'https://instagram.com/jahitan.nenek', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_whatsapp_url', 'value' => 'https://wa.me/628123456789', 'type' => 'string', 'group' => 'cms'],

            // Hero Section (ID)
            ['key' => 'cms_hero_title_id', 'value' => 'Rajutan Kasih Sayang, Warisan Tradisi.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_subtitle_id', 'value' => 'Setiap benang dirajut dengan sabar dan teliti untuk menciptakan kehangatan yang tak lekang oleh waktu.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_cta_id', 'value' => 'Jelajahi Koleksi', 'type' => 'string', 'group' => 'cms'],

            // Hero Section (EN)
            ['key' => 'cms_hero_title_en', 'value' => 'Knitted with Love, Crafted for Heritage.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_subtitle_en', 'value' => 'Every thread is woven with patience and care to create timeless warmth and elegance.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_cta_en', 'value' => 'Explore Collection', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_hero_image', 'value' => 'https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&q=80&w=1200', 'type' => 'string', 'group' => 'cms'],

            // About Us Section (ID)
            ['key' => 'cms_about_title_id', 'value' => 'Cerita di Balik Jahitan', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_about_text_id', 'value' => 'Dimulai dari sebuah hobi merajut dari Nenek yang menyukai kehangatan benang wol untuk cucu tercintanya. Kini Jahitan Nenek hadir untuk membagikan rajutan berkualitas premium, dibuat manual dengan detail presisi tinggi, dan dikerjakan penuh kasih sayang.', 'type' => 'string', 'group' => 'cms'],

            // About Us Section (EN)
            ['key' => 'cms_about_title_en', 'value' => 'Stories Behind the Needles', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_about_text_en', 'value' => 'It started as a knitting hobby from Grandma, who loved the warmth of wool yarns for her beloved grandchildren. Today, Jahitan Nenek is here to share premium quality knits, crafted manually with high precision and filled with genuine affection.', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_about_image', 'value' => 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1200', 'type' => 'string', 'group' => 'cms'],

            // Features Section (ID)
            ['key' => 'cms_features_title_id', 'value' => 'Mengapa Memilih Kami', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_subtitle_id', 'value' => 'Kualitas di Setiap Simpul', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_desc_id', 'value' => 'Kami berdedikasi untuk memberikan pengalaman terbaik melalui produk rajutan tangan yang otentik dan layanan yang ramah.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_title_id', 'value' => 'Dibuat Penuh Cinta', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_desc_id', 'value' => 'Setiap produk dirajut secara manual untuk memastikan kualitas dan keunikan yang tidak bisa ditiru mesin.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_title_id', 'value' => 'Bahan Premium', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_desc_id', 'value' => 'Kami menggunakan benang wool pilihan yang lembut di kulit dan tahan lama untuk menemani hari-harimu.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_title_id', 'value' => 'Pengiriman Aman', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_desc_id', 'value' => 'Pengiriman aman ke seluruh Indonesia dengan kemasan ramah lingkungan yang premium.', 'type' => 'string', 'group' => 'cms'],

            // Features Section (EN)
            ['key' => 'cms_features_title_en', 'value' => 'Why Choose Us', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_subtitle_en', 'value' => 'Quality in Every Knot', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_desc_en', 'value' => 'We are dedicated to providing the best experience through authentic hand-knitted products and friendly service.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_title_en', 'value' => 'Handmade with Love', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_desc_en', 'value' => 'Each product is hand-knitted to ensure quality and uniqueness that machines cannot replicate.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_title_en', 'value' => 'Premium Material', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_desc_en', 'value' => 'We use selected wool yarns that are soft on the skin and durable to accompany your days.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_title_en', 'value' => 'Safe Delivery', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_desc_en', 'value' => 'Safe shipping throughout Indonesia with premium eco-friendly packaging.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Section (ID)
            ['key' => 'cms_gallery_title_id', 'value' => 'Galeri Karya', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_desc_id', 'value' => 'Setiap simpul menceritakan dedikasi, kehangatan, dan kesabaran.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Section (EN)
            ['key' => 'cms_gallery_title_en', 'value' => 'Work Gallery', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_desc_en', 'value' => 'Every knot tells a story of dedication, warmth, and patience.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Items
            ['key' => 'cms_gallery_img1', 'value' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title1_id', 'value' => 'Kardigan Klasik', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title1_en', 'value' => 'Classic Cardigan', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img2', 'value' => 'https://images.unsplash.com/photo-1544967082-d9d25d867d66?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title2_id', 'value' => 'Koleksi Amigurumi', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title2_en', 'value' => 'Amigurumi Collection', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img3', 'value' => 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title3_id', 'value' => 'Dekorasi Rumah', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title3_en', 'value' => 'Home Decor', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img4', 'value' => 'https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title4_id', 'value' => 'Seri Vintage', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title4_en', 'value' => 'Vintage Series', 'type' => 'string', 'group' => 'cms'],

            // Visibilities
            ['key' => 'cms_section_hero_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
            ['key' => 'cms_section_products_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
            ['key' => 'cms_section_features_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
            ['key' => 'cms_section_recommendations_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
            ['key' => 'cms_section_blog_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
            ['key' => 'cms_section_gallery_active', 'value' => '1', 'type' => 'boolean', 'group' => 'cms'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
