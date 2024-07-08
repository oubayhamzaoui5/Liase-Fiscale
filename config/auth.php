<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'contribuables',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'contribuables',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'contribuables',
            'hash' => false,
        ],
    ],

    'providers' => [
        'contribuables' => [
            'driver' => 'eloquent',
            'model' => App\Models\Contribuable::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'contribuables' => [
            'provider' => 'contribuables',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
