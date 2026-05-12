<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $origin;

    public function __construct()
    {
        $this->apiKey = SiteSetting::get('rajaongkir_api_key');
        $this->baseUrl = 'https://api.rajaongkir.com/starter'; // Default to starter
        $this->origin = SiteSetting::get('rajaongkir_origin_city', '152'); // Default to Jakarta Barat
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/province");

        return $response->json()['rajaongkir']['results'] ?? [];
    }

    public function getCities($provinceId = null)
    {
        $url = "{$this->baseUrl}/city";
        if ($provinceId) {
            $url .= "?province={$provinceId}";
        }

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($url);

        return $response->json()['rajaongkir']['results'] ?? [];
    }

    public function getCost($destination, $weight, $courier = 'jne')
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post("{$this->baseUrl}/cost", [
            'origin' => $this->origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        return $response->json()['rajaongkir']['results'] ?? [];
    }
}
