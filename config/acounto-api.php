<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Acounto API Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration of the Acounto API, such as
    | API keys, environment URLs, and default settings for requests.
    |
    */

    'api_key' => env('ACOUNTO_API_KEY', ''),

    // Environment-based URLs
    'base_url' => env('ACOUNTO_ENV', 'dev') === 'prod'
        ? 'https://bulk.acounto.com/'
        : 'https://bulk.acounto.dev/',
];
