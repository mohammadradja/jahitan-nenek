<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('superadmin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section');
        $data = $request->except(['_token', 'section']);
        
        // Handle brand logo and favicon uploads
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('brand', $filename, 'public');
            SiteSetting::set('site_logo', 'storage/' . $path);
        }
        
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $filename = 'favicon-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('brand', $filename, 'public');
            SiteSetting::set('site_favicon', 'storage/' . $path);
        }

        // Handle CMS Landing Page Image Uploads
        if ($request->hasFile('cms_hero_image')) {
            $file = $request->file('cms_hero_image');
            $filename = 'hero-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cms', $filename, 'public');
            SiteSetting::set('cms_hero_image', 'storage/' . $path);
        }

        if ($request->hasFile('cms_about_image')) {
            $file = $request->file('cms_about_image');
            $filename = 'about-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cms', $filename, 'public');
            SiteSetting::set('cms_about_image', 'storage/' . $path);
        }

        foreach ($data as $key => $value) {
            if (in_array($key, ['site_logo', 'site_favicon', 'cms_hero_image', 'cms_about_image'])) {
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
}
