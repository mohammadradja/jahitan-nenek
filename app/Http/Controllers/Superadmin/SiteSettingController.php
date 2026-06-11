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
            SiteSetting::set($key, $value);
        }

        $message = 'Pengaturan ' . ($section ?? 'sistem') . ' berhasil diperbarui.';
        return redirect()->back()->with('success', $message);
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
}
