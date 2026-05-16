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
        
        foreach ($data as $key => $value) {
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
                case 'rajaongkir':
                    $service = new \App\Services\RajaOngkirService();
                    $provinces = $service->getProvinces();
                    if (!empty($provinces)) {
                        return response()->json(['success' => true, 'message' => 'Koneksi RajaOngkir Berhasil! ' . count($provinces) . ' provinsi dimuat.']);
                    }
                    return response()->json(['success' => false, 'message' => 'Gagal terhubung ke RajaOngkir. Cek API Key.']);

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
