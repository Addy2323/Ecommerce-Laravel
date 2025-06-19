<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'            => 'APP-80W284485P519543T',
        'api_endpoint'      => 'https://api-m.sandbox.paypal.com',
        'gateway_endpoint'  => 'https://api-m.sandbox.paypal.com',
        'ipn_notification_url' => '',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
        'api_endpoint'      => 'https://api-m.paypal.com',
        'gateway_endpoint'  => 'https://api-m.paypal.com',
        'ipn_notification_url' => '',
    ],
    'http' => [
        'retry' => 1,
        'verify' => true, // Verify SSL certificate
        'timeout' => 30, // Increase timeout to 30 seconds
        'connection_timeout' => 10,
        // 'proxy' => 'http://proxy.example.com:8080', // Uncomment and update if behind a proxy
    ],
    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
