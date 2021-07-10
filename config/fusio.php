<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Fusio SDK Configuration
    |--------------------------------------------------------------------------
    |
    | Contains the configuration to access a Fusio instance. More information about
    | Fusio at https://www.fusio-project.org/ or https://github.com/apioo/fusio
    |
    */
    'base_uri' => env('FUSIO_BASE_URI'),
    'app_key' => env('FUSIO_APP_KEY'),
    'app_secret' => env('FUSIO_APP_SECRET'),
    'scopes' => null, // optional an array of scopes

];
