<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark bg-surface-50 dark:bg-surface-950">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes

            {{
                Vite::useHotFile(public_path('/mail-log-hot'))
                ->withEntryPoints(['resources/js/app.ts'])
                ->useBuildDirectory('')
                ->useManifestFilename('../vendor/gearbox-solutions/mail-log/dist/build/manifest.json')
            ->createAssetPathsUsing(function (string $path, ?bool $secure) { // Customize the backend path generation for built assets...
                return "/mail-log/build{$path}";
            })
            }}


        @inertiaHead

        <!-- PWA -->
        <link rel="manifest" href="/mail-log/build/manifest.json" type="application/manifest+json"/>
        <meta name="theme-color" content="#111827">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/mail-log/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/mail-log/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/mail-log/favicons/favicon-16x16.png">
        <link rel="manifest" href="/mail-log/favicons/site.webmanifest">
        <link rel="mask-icon" href="/mail-log/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/mail-log/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/mail-log/favicons/browserconfig.xml">

    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
