<?php

// SSLCommerz configuration

return [
    'projectPath' => env('PROJECT_PATH'),
    // For Sandbox, use "https://sandbox.sslcommerz.com"
    // For Live, use "https://securepay.sslcommerz.com"
    'apiDomain' => env("API_DOMAIN_URL", "https://sandbox.sslcommerz.com"),
    'apiCredentials' => [
        'store_id' => "gonot5f0094e9cdbb0",
        'store_password' => "gonot5f0094e9cdbb0@ssl",
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
    'success_url' => '/order/payment/success',
    'failed_url' => '/order/payment/failed',
    'cancel_url' => '/order/payment/cancel',
    'ipn_url' => '/order/payment/ipn',
];
