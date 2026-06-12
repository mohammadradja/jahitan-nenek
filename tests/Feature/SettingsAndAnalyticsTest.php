<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SettingsAndAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_site_setting_reads_raw_strings_and_json_encoded_values(): void
    {
        DB::table('site_settings')->insert([
            [
                'key' => 'raw_text',
                'value' => 'Jahitan Nenek',
                'type' => 'string',
                'group' => 'general',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'json_text',
                'value' => '"Galeri Karya"',
                'type' => 'string',
                'group' => 'cms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        SiteSetting::set('array_value', ['id' => 'Halo', 'en' => 'Hello'], 'array', 'cms');

        $this->assertSame('Jahitan Nenek', SiteSetting::get('raw_text'));
        $this->assertSame('Galeri Karya', SiteSetting::get('json_text'));
        $this->assertSame(['id' => 'Halo', 'en' => 'Hello'], SiteSetting::get('array_value'));
    }

    public function test_click_analytics_event_can_be_recorded(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $response = $this->postJson(route('analytics.click'), [
            'path' => 'product/kebaya',
            'target' => 'Beli Sekarang',
        ]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas('analytics_events', [
            'event_type' => 'click',
            'path' => 'product/kebaya',
            'target' => 'Beli Sekarang',
        ]);
    }

    public function test_admin_can_update_dedicated_promo_popup_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.promo.update'), [
            'promo_enabled' => '1',
            'promo_label' => 'Promo Lebaran',
            'promo_original_price' => '250000',
            'promo_real_price' => '175000',
            'promo_description' => 'Harga spesial untuk koleksi terbatas.',
            'promo_popup_enabled' => '1',
            'promo_popup_title' => 'Diskon Koleksi Baru',
            'promo_popup_message' => 'Cek promo terbaru sebelum selesai.',
            'promo_popup_cta_label' => 'Belanja Sekarang',
            'promo_popup_cta_url' => '/#produk',
            'notification_enabled' => '1',
            'notification_title' => 'Info Toko',
            'notification_message' => 'Pesanan custom tetap dibuka.',
        ]);

        $response->assertRedirect();
        $this->assertSame(1, SiteSetting::get('promo_enabled'));
        $this->assertSame('Diskon Koleksi Baru', SiteSetting::get('promo_popup_title'));
        $this->assertSame('Pesanan custom tetap dibuka.', SiteSetting::get('notification_message'));
    }

    public function test_settings_pages_render_for_admin_and_superadmin(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $superadmin = User::factory()->create(['role' => 'superadmin']);

        $this->actingAs($admin)
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee('Pengaturan Sistem &amp; CMS', false);

        $this->actingAs($superadmin)
            ->get(route('superadmin.settings.index'))
            ->assertOk()
            ->assertSee('Pengaturan Sistem &amp; CMS', false);
    }

    public function test_admin_cms_update_writes_localized_content_visible_in_preview(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        SiteSetting::set('default_language', 'id');
        SiteSetting::set('cms_hero_title_id', 'Judul Lama', 'string', 'cms');

        $response = $this->actingAs($admin)
            ->postJson(route('admin.cms.update'), [
                'cms_hero_title_id' => 'Judul Preview Baru',
                'cms_hero_subtitle_id' => 'Subjudul baru untuk preview CMS.',
                'cms_hero_cta_id' => 'Lihat Karya',
                'cms_about_title_id' => 'Cerita Baru',
                'cms_about_text_id' => 'Isi cerita baru untuk halaman tentang.',
                'cms_section_hero_active' => '1',
                'cms_section_products_active' => '1',
                'cms_section_features_active' => '1',
                'cms_section_recommendations_active' => '1',
                'cms_section_blog_active' => '1',
                'cms_section_gallery_active' => '1',
            ]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertSame('Judul Preview Baru', SiteSetting::get('cms_hero_title_id'));

        $this->actingAs($admin)
            ->get('/?preview_as_guest=true')
            ->assertOk()
            ->assertSee('Judul Preview Baru')
            ->assertSee('Subjudul baru untuk preview CMS.')
            ->assertDontSee('Judul Lama');
    }
}
