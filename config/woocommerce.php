<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Home URL to the store you want to connect to here
    |--------------------------------------------------------------------------
    */
    'store_url' => env('WOOCOMMERCE_STORE_URL', 'http://localhost/wk'),

    /*
    |--------------------------------------------------------------------------
    | Consumer Key
    |--------------------------------------------------------------------------
    */
    'consumer_key' => env('WOOCOMMERCE_CONSUMER_KEY', 'ck_b40e1040391f086763b5062053f464b560c11e28'),

    /*
    |--------------------------------------------------------------------------
    | Consumer Secret
    |--------------------------------------------------------------------------
    */
    'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET', 'cs_b07dcafdbe32ac978edaed999800b1788764c6e4'),

    /*
    |--------------------------------------------------------------------------
    | SSL support
    |--------------------------------------------------------------------------
    */
    'verify_ssl' => env('WOOCOMMERCE_VERIFY_SSL', false),

    /*
    |--------------------------------------------------------------------------
    | API version
    |--------------------------------------------------------------------------
    */
    'api_version' => env('WOOCOMMERCE_VERSION', 'v2'),

    /*
    |--------------------------------------------------------------------------
    | WP API usage
    |--------------------------------------------------------------------------
    */
    'wp_api' => env('WOOCOMMERCE_WP_API', true),

    /*
    |--------------------------------------------------------------------------
    | Force Basic Authentication as query string
    |--------------------------------------------------------------------------
    */
    'query_string_auth' => env('WOOCOMMERCE_WP_QUERY_STRING_AUTH', false),

    /*
    |--------------------------------------------------------------------------
    | WP timeout
    |--------------------------------------------------------------------------
    */
    'timeout' => env('WOOCOMMERCE_WP_TIMEOUT', 15),
];
