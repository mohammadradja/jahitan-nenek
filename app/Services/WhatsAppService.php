<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $enabled;

    public function __construct()
    {
        $this->token = SiteSetting::get('whatsapp_api_token');
        $this->enabled = SiteSetting::get('whatsapp_enabled', false);
    }

    public function sendMessage($target, $message)
    {
        if (!$this->enabled || !$this->token) {
            Log::info("WhatsApp disabled or token missing. Target: {$target}");
            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => $this->token
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
        ]);

        if ($response->successful()) {
            return true;
        }

        Log::error("WhatsApp send failed: " . $response->body());
        return false;
    }

    public function sendOrderStatusUpdate($order)
    {
        $status = strtoupper($order->status);
        $message = "Halo {$order->customer_name},\n\n";
        $message .= "Status pesanan Anda #{$order->invoice_number} telah diperbarui menjadi: *{$status}*.\n\n";
        $message .= "Terima kasih telah berbelanja di Jahitan Nenek! 🧶";

        return $this->sendMessage($order->customer_phone, $message);
    }
}
