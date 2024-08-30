<?php

namespace Tests\Unit\Services;

use App\Services\OpenEdService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class OpenEdServiceTest extends TestCase
{
    protected Client $clientMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientMock = Mockery::mock(Client::class);

        $this->app->instance(Client::class, $this->clientMock);
    }

    public function test_fetch_by_subject_success()
    {
        $responseData = [
            'resources' => [
                ['title' => 'Resource 1', 'url' => 'http://api.opened.com/1'],
                ['title' => 'Resource 2', 'url' => 'http://api.opened.com/2'],
            ],
        ];

        // Mock the HTTP client to return a successful response
        $this->clientMock
            ->shouldReceive('get')
            ->with('resources', [
                'query' => [
                    'subject' => 'math',
                    'limit' => 5,
                    'sort' => 'relevance',
                    'api_key' => config('services.opened.api_key'),
                ],
            ])
            ->andReturn(new Response(200, [], json_encode($responseData)));

        // Mock the Cache facade
        Cache::shouldReceive('store')
            ->with('redis')
            ->andReturn(Cache::getFacadeRoot());

        Cache::shouldReceive('remember')
            ->withArgs(function ($key, $ttl, $callback) {
                return $key === 'openEdx_'.md5('math') && $ttl === 3600;
            })
            ->andReturn($responseData['resources']);

        $service = new OpenEdService;
        $result = $service->fetchBySubject('math');

        $this->assertEquals($responseData['resources'], $result);
    }

    public function test_fetch_by_subject_error()
    {
        // Mock the HTTP client to throw an exception
        $this->clientMock
            ->shouldReceive('get')
            ->andThrow(new \Exception('API request failed'));

        // Mock the Cache facade
        Cache::shouldReceive('store')
            ->with('redis')
            ->andReturn(Cache::getFacadeRoot());

        Cache::shouldReceive('remember')
            ->withArgs(function ($key, $ttl, $callback) {
                return $key === 'openEdx_'.md5('science') && $ttl === 3600;
            })
            ->andReturn([]);

        // Mock the Log facade
        Log::shouldReceive('error')
            ->withArgs(function ($message) {
                return str_contains($message, 'OpenEd API error: API request failed');
            });

        $service = new OpenEdService;
        $result = $service->fetchBySubject('science');

        $this->assertEquals([], $result);
    }
}
