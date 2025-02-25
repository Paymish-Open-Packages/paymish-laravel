<?php

namespace Paymish\Http;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class PaymishClient
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = Config::get('paymish.base_url');
        $this->apiKey = Config::get('paymish.api_key');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ]
        ]);
    }

    public function get(string $endpoint, array $query = [])
    {
        $response = $this->client->get($endpoint, ['query' => $query]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function post(string $endpoint, array $data = [])
    {
        $response = $this->client->post($endpoint, ['json' => $data]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
