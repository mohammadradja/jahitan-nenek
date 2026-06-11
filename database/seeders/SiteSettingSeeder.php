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
            ['key' => 'site_tagline', 'value' => 'Jahitan Kasih Sayang Premium', 'type' => 'string', 'group' => 'general'],
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
            ['key' => 'cms_hero_title_id', 'value' => 'Jahitan Kasih Sayang, Warisan Tradisi.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_subtitle_id', 'value' => 'Setiap jahitan menyimpan kasih sayang. Setiap pakaian membawa cerita. Dan setiap cerita layak untuk dikenang.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_cta_id', 'value' => 'Jelajahi Koleksi', 'type' => 'string', 'group' => 'cms'],

            // Hero Section (EN)
            ['key' => 'cms_hero_title_en', 'value' => 'Stitched with Love, Crafted for Heritage.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_subtitle_en', 'value' => 'Every stitch holds affection. Every garment carries a story. And every story deserves to be remembered.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_hero_cta_en', 'value' => 'Explore Collection', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_hero_image', 'value' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=1200', 'type' => 'string', 'group' => 'cms'],

            // About Us Section (ID)
            ['key' => 'cms_about_title_id', 'value' => 'Cerita di Balik Jahitan', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_about_text_id', 'value' => 'Jahitan Nenek bermula dari sebuah ruang tamu kecil di mana jemari tua namun lincah menjahit potongan-potongan bahan menjadi keindahan.', 'type' => 'string', 'group' => 'cms'],

            // About Us Section (EN)
            ['key' => 'cms_about_title_en', 'value' => 'Stories Behind the Needles', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_about_text_en', 'value' => 'Jahitan Nenek began in a small living room where old but agile fingers stitched pieces of fabric into beauty.', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_about_image', 'value' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&q=80&w=1200', 'type' => 'string', 'group' => 'cms'],

            // Features Section (ID)
            ['key' => 'cms_features_title_id', 'value' => 'Mengapa Memilih Kami', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_subtitle_id', 'value' => 'Kualitas di Setiap Jahitan', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_desc_id', 'value' => 'Kami berdedikasi untuk memberikan pengalaman terbaik melalui produk jahitan yang otentik dan layanan yang ramah.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_title_id', 'value' => 'Dibuat Penuh Cinta', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_desc_id', 'value' => 'Jahitan Nenek memadukan nilai craftsmanship klasik dengan estetika kontemporer. Hasilnya adalah pakaian yang terasa akrab namun tetap segar, sederhana namun berkarakter.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_title_id', 'value' => 'Bahan Premium', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_desc_id', 'value' => 'Seperti nenek yang menjahit dengan penuh kesabaran dan kasih sayang, setiap produk dibuat untuk bertahan lama dan memiliki nilai lebih dari sekadar pakaian.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_title_id', 'value' => 'Pengiriman Aman', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_desc_id', 'value' => 'Pengiriman aman ke seluruh Indonesia dengan kemasan ramah lingkungan yang premium.', 'type' => 'string', 'group' => 'cms'],

            // Features Section (EN)
            ['key' => 'cms_features_title_en', 'value' => 'Why Choose Us', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_subtitle_en', 'value' => 'Quality in Every Stitch', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_features_desc_en', 'value' => 'We are dedicated to providing the best experience through authentic stitched garments and friendly service.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_title_en', 'value' => 'Handmade with Love', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature1_desc_en', 'value' => 'Jahitan Nenek blends classic craftsmanship with contemporary aesthetics, creating garments that feel familiar yet fresh, simple yet full of character.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_title_en', 'value' => 'Premium Material', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature2_desc_en', 'value' => 'Like a grandmother sewing with patience and affection, every product is made to last and hold more value than clothing alone.', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_title_en', 'value' => 'Safe Delivery', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_feature3_desc_en', 'value' => 'Safe shipping throughout Indonesia with premium eco-friendly packaging.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Section (ID)
            ['key' => 'cms_gallery_title_id', 'value' => 'Galeri Karya', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_subtitle_id', 'value' => 'Mahakarya Jahitan', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_desc_id', 'value' => 'Setiap jahitan menceritakan dedikasi, kehangatan, dan kesabaran.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Section (EN)
            ['key' => 'cms_gallery_title_en', 'value' => 'Work Gallery', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_subtitle_en', 'value' => 'Stitched Masterpiece', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_desc_en', 'value' => 'Every stitch tells a story of dedication, warmth, and patience.', 'type' => 'string', 'group' => 'cms'],

            // Gallery Items
            ['key' => 'cms_gallery_img1', 'value' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title1_id', 'value' => 'Brukat Klasik', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title1_en', 'value' => 'Classic Brocade', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img2', 'value' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title2_id', 'value' => 'Atasan Brukat', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title2_en', 'value' => 'Brocade Tops', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img3', 'value' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title3_id', 'value' => 'Dress Brukat', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title3_en', 'value' => 'Brocade Dresses', 'type' => 'string', 'group' => 'cms'],

            ['key' => 'cms_gallery_img4', 'value' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=1000', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title4_id', 'value' => 'Seri Modern', 'type' => 'string', 'group' => 'cms'],
            ['key' => 'cms_gallery_title4_en', 'value' => 'Modern Series', 'type' => 'string', 'group' => 'cms'],

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
