<?php

use GearboxSolutions\MailLog\Http\Controllers\AssetController;
use GearboxSolutions\MailLog\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'mail-log',
    'middleware' => array_merge([
        \GearboxSolutions\MailLog\Middleware\HandleInertiaRequests::class,
    ], config('mail-log.middleware', [])),
], function () {

    Route::get('/', [MailController::class, 'index'])->name('mail.index');
    Route::get('/{id}', [MailController::class, 'show'])->name('mail.show');

    // Serve the built front-end assets
    Route::get('/build/{path}', [AssetController::class, 'show'])->where('path', '.*');
    // serve content in the favicons folder
    Route::get('/favicons/{path}', function ($path) {
        return response()->file(__DIR__.'/../dist/favicons/'.$path);
    });

});
