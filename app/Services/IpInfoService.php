<?php

namespace App\Services;

use GuzzleHttp\Client;

class IpInfoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://ipinfo.io/'
        ]);
    }

    public function getLocation($ip)
    {
        $apiKey = config('services.ipinfo.token'); // Dapatkan API key dari file konfigurasi
        $response = $this->client->get($ip, [
            'query' => ['token' => $apiKey]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
