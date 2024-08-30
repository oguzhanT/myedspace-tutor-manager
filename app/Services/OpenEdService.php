<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OpenEdService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.opened.com/',
        ]);
    }

    public function fetchBySubject(string $subject): array
    {
        $cacheKey = 'openEdx_'.md5($subject);

        // Use Redis to cache the API response
        return Cache::store('redis')->remember($cacheKey, 3600, function () use ($subject) {
            try {
                $response = $this->client->get('resources', [
                    'query' => [
                        'subject' => $subject,
                        'limit' => 5,
                        'sort' => 'title',
                        'api_key' => config('services.opened.api_key'),
                    ],
                ]);

                $data = json_decode($response->getBody()->getContents(), true);

                return $data['resources'] ?? [];
            } catch (\Exception $e) {
                Log::error('OpenEd API error: '.$e->getMessage());

                return [];
            }
        });
    }
}
