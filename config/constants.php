<?php

/*
  |--------------------------------------------------------------------------
  | constants. All over the project
  |--------------------------------------------------------------------------
 */

return [

    'p_key' => env('P_KEY'),
    'status' => [
        0 => 'Inactive',
        1 => 'Active',
    ],
    'pagination' => [
        1 => '10',
        2 => '20',
        3 => '50',
        4 => '100',
    ],
    'gender' => [
        1 => 'Male',
        2 => 'Female',
        3 => 'Other',
    ],
    'contact_status' => [
        1 => 'Pending',
        2 => 'Open',
        3 => 'In-progress',
        4 => 'Closed',
    ],
    'API' => [
        'XAPI' => env('XAPI'),
    ],
    'MAIL_ENCRYPTION' => [
        'tls' => 'TLS',
        'ssl' => 'SSL',
    ],

    'folders' => [
        'profile' => env('USER_IMAGES_FOLDER', 'profile_pic'),
    ]
];
