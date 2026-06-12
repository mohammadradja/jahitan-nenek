<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('superadmin.settings.index', compact('settings'));
    }

    public function promo()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('superadmin.settings.promo', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate($this->imageValidationRules());

        $section = $request->input('section');
        $data = $request->except(['_token', 'section']);
        
        $fileKeys = ['site_logo', 'site_favicon', 'cms_hero_image', 'cms_about_image', 'cms_gallery_img1', 'cms_gallery_img2', 'cms_gallery_img3', 'cms_gallery_img4'];

        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                SiteSetting::set($key, $this->storeImage($request, $key), 'string', $section ?? 'cms');
            }
        }

        foreach ($data as $key => $value) {
            if (in_array($key, $fileKeys)) {
                continue;
            }
            SiteSetting::set($key, $value, $this->inferType($key, $value), $section ?? 'general');
        }

        $message = 'Pengaturan ' . ($section ?? 'sistem') . ' berhasil diperbarui.';
        return redirect()->back()->with('success', $message);
    }

    public function updatePromo(Request $request)
    {
        $validated = $request->validate([
            'promo_enabled' => ['required', 'in:0,1'],
            'promo_label' => ['nullable', 'string', 'max:120'],
            'promo_original_price' => ['nullable', 'integer', 'min:0'],
            'promo_real_price' => ['nullable', 'integer', 'min:0'],
            'promo_description' => ['nullable', 'string', 'max:255'],
            'promo_popup_enabled' => ['required', 'in:0,1'],
            'promo_popup_title' => ['nullable', 'string', 'max:140'],
            'promo_popup_message' => ['nullable', 'string', 'max:500'],
            'promo_popup_cta_label' => ['nullable', 'string', 'max:80'],
            'promo_popup_cta_url' => ['nullable', 'string', 'max:255'],
            'notification_enabled' => ['required', 'in:0,1'],
            'notification_title' => ['nullable', 'string', 'max:140'],
            'notification_message' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, $this->inferType($key, $value), str_starts_with($key, 'notification_') ? 'notifications' : 'promo');
        }

        return redirect()->back()->with('success', 'Pengaturan promo berhasil diperbarui.');
    }

    public function testConnection(Request $request)
    {
        $type = $request->input('type');

        try {
            switch ($type) {
                case 'whatsapp':
                    $service = new \App\Services\WhatsAppService();
                    $result = $service->sendMessage(SiteSetting::get('whatsapp_number'), 'Test koneksi Jahitan Nenek - API Fonnte berhasil!');
                    if ($result) {
                        return response()->json(['success' => true, 'message' => 'Pesan WhatsApp berhasil dikirim ke nomor center!']);
                    }
                    return response()->json(['success' => false, 'message' => 'Gagal mengirim pesan WhatsApp. Cek Token/Base URL.']);

                case 'midtrans':
                    $serverKey = SiteSetting::get('midtrans_server_key');
                    $isProd = SiteSetting::get('midtrans_is_production', false);
                    $snapUrl = $isProd ? 'https://app.midtrans.com/snap/v1/token' : 'https://app.sandbox.midtrans.com/snap/v1/token';
                    
                    $response = Http::withBasicAuth($serverKey, '')->post($snapUrl, [
                        'transaction_details' => [
                            'order_id' => 'TEST-' . time(),
                            'gross_amount' => 10000
                        ]
                    ]);

                    if ($response->successful()) {
                        return response()->json(['success' => true, 'message' => 'Koneksi Midtrans Berhasil! Token transaksi percobaan didapatkan.']);
                    }
                    return response()->json(['success' => false, 'message' => 'Gagal terhubung ke Midtrans: ' . ($response->json()['error_messages'][0] ?? 'Unknown Error')]);

                default:
                    return response()->json(['success' => false, 'message' => 'Tipe pengujian tidak dikenal.']);
            }
        } catch (\Exception $e) {
            Log::error("Test Connection Error ({$type}): " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Kesalahan Teknis: ' . $e->getMessage()]);
        }
    }

    private function storeImage(Request $request, string $key): string
    {
        File::ensureDirectoryExists(public_path('assets/images/settings'));

        $file = $request->file($key);
        $filename = Str::slug($key) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/settings'), $filename);

        return 'assets/images/settings/' . $filename;
    }

    private function imageValidationRules(): array
    {
        $rules = [];

        foreach (['site_logo', 'site_favicon', 'cms_hero_image', 'cms_about_image', 'cms_gallery_img1', 'cms_gallery_img2', 'cms_gallery_img3', 'cms_gallery_img4'] as $key) {
            $rules[$key] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:5120'];
        }

        return $rules;
    }

    private function inferType(string $key, $value): string
    {
        if (str_contains($key, 'price') || str_contains($key, 'cost') || str_contains($key, 'position')) {
            return is_numeric($value) ? 'decimal' : 'string';
        }

        if (is_bool($value) || in_array($value, ['0', '1'], true)) {
            return 'boolean';
        }

        if (is_numeric($value) && preg_match('/^-?\d+$/', (string) $value)) {
            return 'integer';
        }

        return 'string';
    }
}
