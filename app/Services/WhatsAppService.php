<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $baseUrl;
    protected $enabled;

    public function __construct()
    {
        $this->token = SiteSetting::get('whatsapp_api_token');
        $this->baseUrl = SiteSetting::get('whatsapp_base_url', 'https://api.fonnte.com/send');
        $this->enabled = SiteSetting::get('whatsapp_enabled', false);
    }

    public function sendMessage($target, $message)
    {
        if (!$this->enabled || !$this->token) {
            Log::info("WhatsApp disabled or token missing. Target: {$target}");
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token
            ])->timeout(10)->post($this->baseUrl, [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default Indonesia
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp message sent to {$target}");
                return true;
            }

            Log::error("WhatsApp send failed: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("WhatsApp Connection Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendOrderStatusUpdate($order)
    {
        $statusMap = [
            'pending' => 'Menunggu Pembayaran',
            'processing' => 'Sedang Dirajut (Diproses)',
            'shipped' => 'Dalam Pengiriman',
            'completed' => 'Selesai & Diterima',
            'cancelled' => 'Dibatalkan',
            'pending_manual_approval' => 'Menunggu Verifikasi Admin',
        ];

        $statusLabel = $statusMap[$order->status] ?? strtoupper($order->status);
        $emoji = $order->status === 'completed' ? '🎉' : ($order->status === 'shipped' ? '🚚' : '🧶');

        $message = "*JAHITAN NENEK - Update Pesanan* {$emoji}\n\n";
        $message .= "Halo *{$order->customer_name}*,\n";
        $message .= "Status pesanan Anda *#{$order->invoice_number}* telah diperbarui menjadi:\n\n";
        $message .= "👉 *{$statusLabel}*\n\n";
        
        if ($order->status === 'shipped' && $order->tracking_number) {
            $message .= "Nomor Resi: *{$order->tracking_number}*\n";
            $message .= "Kurir: *".strtoupper($order->courier)."*\n\n";
        }

        $message .= "Anda dapat memantau detail pesanan di sini:\n";
        $message .= route('order.track') . "?order_id={$order->id}&email={$order->customer_email}\n\n";
        $message .= "Terima kasih telah menghargai karya tangan kami! ❤️";

        return $this->sendMessage($order->customer_phone, $message);
    }
}
