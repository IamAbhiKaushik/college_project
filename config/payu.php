<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Payment Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the environment of the payment gateway.
    | Possible options:
    | "test" For testing and development.
    | "secure" For live payment.
    |
    */

    'env' => 'test',

    /*
    |--------------------------------------------------------------------------
    | Default Account to use
    |--------------------------------------------------------------------------
    |
    | The account to be used for Payment
    |
    */
    'default' => 'payumoney',

    /*
    |--------------------------------------------------------------------------
    | All Accounts array
    |--------------------------------------------------------------------------
    |
    | All the different accounts with its names
    |
    */
    'accounts' => [
        /*
        |--------------------------------------------------------------------------
        | Account Credentials
        |--------------------------------------------------------------------------
        |
        | The account name and credentials which are found in the PayuBiz or
        | PayuMoney Console.
        |
        | key   => (string)     Merchant Key.
        | salt  => (string)     Merchant Salt.
        | money => (boolean)    Is it a payumoney account?
        | auth  => (string)     Authorization Token if it is a payumoney account.
        |
        */
        'payubiz' => [
            'key' => 'gtKFFx',
            'salt' => 'eCwWELxi',
            'money' => false,
            'auth' => null
        ],

        'payumoney' => [
            'key' => 'uarxnU0C',
//            'key' => 'uarxnU0C',
            'salt' => 'q2wCvgmsQQ',
//            'salt' => 'q2wCvgmsQQ',
            'money' => true,
            
            'auth' => 'mim66DLUnVKNkR71A/YsRu6SxQDDjFfacAJXqpOCceQ='
//            'auth' => 'mim66DLUnVKNkR71A/YsRu6SxQDDjFfacAJXqpOCceQ='
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Payu Endpoint.
    |--------------------------------------------------------------------------
    |
    | Payment endpoint for Payu.
    |
    */
    'endpoint' => 'payu.in/_payment',

    /*
    |--------------------------------------------------------------------------
    | Payment Store Driver
    |--------------------------------------------------------------------------
    |
    | This is the config for storing the payment info. I recommend to use
    | database driver for storing then use it for your own use.
    | Options : "database", "session".
    | Note: If you use session driver make sure you are using secure = true
    | in config/session.php
    |
    */
    'driver' => 'database',

    /*
    |--------------------------------------------------------------------------
    | Payu Payment Table
    |--------------------------------------------------------------------------
    |
    | This is table that will be used for storing the payment information.
    | Run: php artisan vendor:publish to get the table in the migrations
    | directory. If you did change the table name then specify here.
    |
    */
    'table' => 'payu_payments',
];
