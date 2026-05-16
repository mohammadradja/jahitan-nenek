<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $origin;

    public function __construct()
    {
        $this->apiKey = SiteSetting::get('rajaongkir_api_key') ?? config('services.rajaongkir.key');
        $this->baseUrl = SiteSetting::get('rajaongkir_base_url') ?? config('services.rajaongkir.base_url', 'https://api.rajaongkir.com/starter');
        $this->origin = SiteSetting::get('rajaongkir_origin_city') ?? config('services.rajaongkir.origin', '152');
    }

    public function getProvinces()
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->timeout(10)->get("{$this->baseUrl}/province");

            if ($response->failed()) {
                Log::error('RajaOngkir Province Error: ' . $response->body());
                return [];
            }

            return $response->json()['rajaongkir']['results'] ?? [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Connection Error (Provinces): ' . $e->getMessage());
            return [];
        }
    }

    public function getCities($provinceId = null)
    {
        try {
            $url = "{$this->baseUrl}/city";
            if ($provinceId) {
                $url .= "?province={$provinceId}";
            }

            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->timeout(10)->get($url);

            if ($response->failed()) {
                Log::error('RajaOngkir City Error: ' . $response->body());
                return [];
            }

            return $response->json()['rajaongkir']['results'] ?? [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Connection Error (Cities): ' . $e->getMessage());
            return [];
        }
    }

    public function getCost($destination, $weight, $courier = 'jne')
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->timeout(10)->post("{$this->baseUrl}/cost", [
                'origin' => $this->origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            if ($response->failed()) {
                Log::error('RajaOngkir Cost Error: ' . $response->body());
                return [];
            }

            return $response->json()['rajaongkir']['results'] ?? [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Connection Error (Cost): ' . $e->getMessage());
            return [];
        }
    }
}
