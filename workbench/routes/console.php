<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail-log:build', function () {
    $this->info('Publishing app view to static HTML...');

    // Ensure dist directory exists
    if (! File::exists(base_path('dist'))) {
        File::makeDirectory(base_path('dist'), 0755, true);
    }

    // Render the view
    $html = View::make('app')->render();

    // Save to dist/index.html
    File::put(base_path('dist/index.html'), $html);

    $this->info('Successfully published to dist/index.html');
})->purpose('Publish MailLog assets');
