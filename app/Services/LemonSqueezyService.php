<?php

namespace App\Services;

use GuzzleHttp\Client;

class LemonSqueezyService
{
    protected $client;
    protected $apiKey;
    protected $storeId;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.lemonsqueezy.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('LEMON_SQUEEZY_API_KEY'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->storeId = env('LEMON_SQUEEZY_STORE_ID');
    }

    public function createCheckout($productId, $email)
    {
        $response = $this->client->post("checkouts", [
            'json' => [
                'data' => [
                    'type' => 'checkouts',
                    'attributes' => [
                        'email' => $email,
                        'product_id' => $productId,
                    ]
                ]
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
