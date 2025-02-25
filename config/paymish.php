<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paymish API Base URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL for the Paymish payment gateway API.
    |
    */
    'base_url' => env('PAYMISH_BASE_URL', 'https://production-api.paymish.com/api/'),

    /*
    |--------------------------------------------------------------------------
    | Paymish API Key
    |--------------------------------------------------------------------------
    |
    | This key is required to authenticate requests to the Paymish API.
    |
    */
    'api_key' => env('PAYMISH_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    | This secret key is used to validate webhook events received from Paymish.
    |
    */
    'webhook_secret' => env('PAYMISH_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | The default currency for transactions processed through Paymish.
    |
    */
    'currency' => env('PAYMISH_CURRENCY', 'NGN'),

    /*
    |--------------------------------------------------------------------------
    | Payment Success & Failure Redirect URLs
    |--------------------------------------------------------------------------
    |
    | These URLs will be used as defaults if not overridden by the request.
    |
    */
    'redirect_urls' => [
        'success' => env('PAYMISH_SUCCESS_URL', 'https://your-site.com/success'),
        'failure' => env('PAYMISH_FAILURE_URL', 'https://your-site.com/failure'),
    ],
];
