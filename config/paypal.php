<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

 return [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // Can be 'sandbox' or 'live'

    'sandbox' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'app_id' => '',
    ],

    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
        'app_id' => '',
    ],

    'payment_action' => 'Sale',
    'currency' => env('PAYPAL_CURRENCY', 'MAD'),
    'notify_url' => env('PAYPAL_NOTIFY_URL', ''),
    'locale' => 'en_US',
    'validate_ssl' => true,
];

