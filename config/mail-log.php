<?php

use Illuminate\Session\Middleware\AuthenticateSession;

return [
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Mail Log route.
    | You can add your own middleware here. Use this to restrict who can see the mail log.
    |
    */
    'middleware' => [AuthenticateSession::class],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    | Configure the database connection to use for storing mail log records
    | If this is null, it uses your default database connection
    |
    */
    'database' => null,
];
