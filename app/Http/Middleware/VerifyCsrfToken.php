<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Livewire file uploads
        'livewire/upload-file',

        // Rutas de tu API que suben archivos a Google Cloud
        'api/upload', // ejemplo si tu endpoint es /api/upload
        'storage/upload', // ejemplo si tu endpoint es /storage/upload

        // Patrón para excluir todas las rutas de subida de archivos
        'gcs/*', // si tus rutas empiezan por gcs/
    ];
}
