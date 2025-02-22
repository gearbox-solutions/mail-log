<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email Logger Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every email logger route.
    | You can add your own middleware here.
    |
    */

    // disable the auth middleware which is used by default
    'middleware' => [],
    'database' => 'sqlite',
];
