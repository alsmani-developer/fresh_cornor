<?php

/**
 * paypal configuration goes here
 */
return [
    // paypal sandbox config
    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET'),

     // paypal live config
     'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
     'live_secret' => env('PAYPAL_LIVE_SECRET'),

     'settings' => [
         // mode sandbox or live
         'mode' => env('PAYPAL_MODE', 'sandbox'),
         'http.ConnectionTimeOut' => 3000,
         // logs
         'log.logEnabled' => true,
         'log.fileName' => storage_path(). '/logs/paypal.log',
         'log.logLevel' => 'DEBUG',
     ],
];