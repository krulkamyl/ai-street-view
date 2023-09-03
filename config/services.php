<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google_maps' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY', ''),
        'output_width' => env('GOOGLE_MAPS_OUTPUT_WIDTH', 800),
        'output_height' => env('GOOGLE_MAPS_OUTPUT_HEIGHT', 600),
    ],
    'getimg' => [
        'api_key' => env('GETIMG_API_KEY', ''),
        'model' => env('GETIMG_MODEL', 'stable-diffusion-v1-5'),
        'strength' => env('GETIMG_STRENGTH', 0.5),
        'steps' => env('GETIMG_STEPS', 50),
        'guidance' => env('GETIMG_GUIDANCE', 2),
        'seed' => env('GETIMG_SEED', 1),
        'scheduler' => env('GETIMG_SCHEDULER', 'dpmsolver++'),
        'output_format' => env('GETIMG_OUTPUT_FORMAT', 'jpeg'),
    ],
    'visual_crossing' => [
        'api_key' => env('VISUAL_CROSSING_API_KEY', ''),
    ]
];
