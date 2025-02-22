<?php

namespace GearboxSolutions\MailLog\Http\Controllers;

use Illuminate\Routing\Controller;

class AssetController extends Controller
{
    public function show(string $path)
    {
        $filePath = __DIR__.'/../../../dist/build/'.$path;

        $mimeTypes = [
            'js' => 'application/javascript',
            'css' => 'text/css',
        ];

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $mimeType = $mimeTypes[$extension] ?? null;

        if (! file_exists($filePath)) {
            abort(404);
        }

        if ($mimeType) {
            return response()->file($filePath, ['Content-Type' => $mimeType]);
        }

        return response()->file($filePath);
    }
}
