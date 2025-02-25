<?php

namespace Paymish\Http;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

class PaymishClient
{
    protected $client;
    protected $baseUrl;
    protected $publicKey;
    protected $secretKey;

    public function __construct()
    {
        $this->baseUrl = Config::get('paymish.base_url');
        $this->publicKey = Config::get('paymish.public_key');
        $this->secretKey = Config::get('paymish.secret_key');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    /**
     * Get authentication token (cached for reuse)
     */
    private function getAuthToken()
    {
        return Cache::remember('paymish_token', 55, function () {
            $response = $this->client->post('/user-service/external/v1/generate-token', [
                'json' => [
                    'public_key' => $this->publicKey,
                    'secret_key' => $this->secretKey
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data['token'] ?? null;
        });
    }

    /**
     * Send GET request
     */
    public function get(string $endpoint, array $query = [], bool $useAuth = true)
    {
        $headers = [];
        if ($useAuth) {
            $headers['Authorization'] = 'Bearer ' . $this->getAuthToken();
        }

        $response = $this->client->get($endpoint, [
            'headers' => $headers,
            'query' => $query
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send POST request
     */
    public function post(string $endpoint, array $data, bool $useSecretKey = false)
    {
        $headers = [];
        if ($useSecretKey) {
            $headers['Authorization'] = 'Bearer ' . $this->secretKey;
        } else {
            $headers['Authorization'] = 'Bearer ' . $this->getAuthToken();
        }

        $response = $this->client->post($endpoint, [
            'headers' => $headers,
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send PUT request
     */
    public function put(string $endpoint, array $data)
    {
        $response = $this->client->put($endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken()
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send DELETE request
     */
    public function delete(string $endpoint)
    {
        $response = $this->client->delete($endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthToken()
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
