<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function uploadLocal(Request $request)
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('posts', 'public');

            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path),
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'No file uploaded.'],
        ]);
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('upload') || !$request->file('upload')->isValid()) {
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => 'No se subió ningún archivo válido.'],
            ]);
        }

        try {
            $file = $request->file('upload');
            $storage = new StorageClient([
                'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
                //'keyFilePath' => base_path('storage/app/google-cloud/seismic-bonfire-468704-c4-76b27da92ee4.json'),
            ]);

            $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));

            // Nombre único para el archivo
            $nombreArchivo = 'posts/' . uniqid() . '_' . $file->getClientOriginalName();

            // Leer contenido del archivo
            $fileContents = file_get_contents($file->getRealPath());

            $bucket->upload($fileContents, [
                'name' => $nombreArchivo,
            ]);

            $url = "https://storage.googleapis.com/" . env('GOOGLE_CLOUD_STORAGE_BUCKET') . "/" . $nombreArchivo;

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => 'Error al subir archivo: ' . $e->getMessage()],
            ]);
        }
    }
}
