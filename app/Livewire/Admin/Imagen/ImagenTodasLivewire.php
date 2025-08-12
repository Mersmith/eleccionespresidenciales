<?php

namespace App\Livewire\Admin\Imagen;

use App\Models\Imagen;
use Google\Cloud\Storage\StorageClient;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class ImagenTodasLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $imagenes_inicial = [], $imagenes_final = [];

    public $modal = false;

    public $imagenId, $url, $titulo, $descripcion, $imagen_edit;

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'imagen_edit' => 'nullable|image|max:2048', //JPEG, PNG, BMP, GIF, SVG, o WEBP //2048 kilobytes (2 MB)
    ];

    protected $validationAttributes = [
        'titulo' => 'título',
        'descripcion' => 'descripción',
        'imagen_edit' => 'imagen',
    ];

    protected $messages = [
        'titulo.required' => 'El :attribute es requerido.',
        'descripcion.required' => 'La :attribute es requerida.',
        'imagen_edit.image' => 'Debe ser tipo imagen',
        'imagen_edit.max' => 'La :attribute no debe superar.',
    ];

    public function updatedImagenesInicial($imagenes_inicial)
    {
        foreach ($imagenes_inicial as $imagen) {
            $this->imagenes_final[] = $imagen;
        }
    }

    public function eliminarImagenTemporal($index)
    {
        array_splice($this->imagenes_final, $index, 1);
    }

    public function eliminarImagenEditTemporal()
    {
        $this->imagen_edit = null;
    }

    public function guardar()
    {
        if (empty($this->imagenes_final)) {
            $this->addError('imagenes_final', 'Debe seleccionar al menos una imagen.');
            return;
        }

        $storage = new StorageClient([
            'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
            'keyFilePath' => base_path('services/google-cloud/seismic-bonfire-468704-c4-76b27da92ee4.json'),
        ]);

        $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));

        foreach ($this->imagenes_final as $imagen) {
            $path = $imagen->getRealPath();

            if (!$path || !file_exists($path)) {
                $this->addError('imagenes_final', "No se pudo acceder al archivo temporal {$imagen->getClientOriginalName()}.");
                continue;
            }

            $fileContents = file_get_contents($path);

            if ($fileContents === false) {
                $this->addError('imagenes_final', "No se pudo leer el archivo {$imagen->getClientOriginalName()}.");
                continue;
            }

            $nombreArchivo = 'images/' . uniqid() . '_' . $imagen->getClientOriginalName();

            $bucket->upload($fileContents, [
                'name' => $nombreArchivo,
            ]);

            $url = "https://storage.googleapis.com/" . env('GOOGLE_CLOUD_STORAGE_BUCKET') . "/" . $nombreArchivo;

            Imagen::create([
                'titulo' => null,
                'path' => $nombreArchivo,
                'url' => $url,
                'descripcion' => null,
            ]);
        }

        $this->reset(['imagenes_inicial', 'imagenes_final', 'titulo', 'descripcion']);
        $this->imagenes = Imagen::all();

        $this->dispatch('alertaLivewire', "Imágenes subidas correctamente.");
    }

    public function seleccionarImagen($id)
    {
        $imagen = Imagen::find($id);
        $this->imagenId = $imagen->id;
        $this->titulo = $imagen->titulo;
        $this->descripcion = $imagen->descripcion;
        $this->url = $imagen->url;

        $this->modal = true;
    }

    public function editarFormulario()
    {
        $this->validate();

        $imagen = Imagen::find($this->imagenId);

        $storage = new StorageClient([
            'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
            'keyFilePath' => base_path('services/google-cloud/seismic-bonfire-468704-c4-76b27da92ee4.json'),
        ]);

        $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));

        $imagen->titulo = $this->titulo;

        if ($this->imagen_edit) {
            // Borrar imagen vieja del bucket
            if ($imagen->path) {
                $object = $bucket->object($imagen->path);
                if ($object->exists()) {
                    $object->delete();
                }
            }

            // Leer nuevo archivo
            $path = $this->imagen_edit->getRealPath();

            if (!$path || !file_exists($path)) {
                $this->addError('imagen_edit', 'No se pudo acceder al archivo nuevo.');
                return;
            }

            $fileContents = file_get_contents($path);

            if ($fileContents === false) {
                $this->addError('imagen_edit', 'No se pudo leer el archivo nuevo.');
                return;
            }

            // Nombre único para el archivo nuevo
            $nombreArchivo = 'images/' . uniqid() . '_' . $this->imagen_edit->getClientOriginalName();

            // Subir nuevo archivo
            $bucket->upload($fileContents, [
                'name' => $nombreArchivo,
            ]);

            // Actualizar datos en DB
            $imagen->path = $nombreArchivo;
            $imagen->url = "https://storage.googleapis.com/" . env('GOOGLE_CLOUD_STORAGE_BUCKET') . "/" . $nombreArchivo;
        }

        $imagen->descripcion = $this->descripcion;
        $imagen->save();

        $this->reset();
        $this->imagenes = Imagen::all();

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    #[On('eliminarImagen')]
    public function eliminarImagen($imagenId)
    {
        $imagen = Imagen::where('id', $imagenId)->first();

        $storage = new StorageClient([
            'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
            'keyFilePath' => base_path('services/google-cloud/seismic-bonfire-468704-c4-76b27da92ee4.json'),
        ]);
        $bucket = $storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));

        // Borrar archivo del bucket
        if ($imagen && $imagen->path) {
            $object = $bucket->object($imagen->path);
            if ($object->exists()) {
                $object->delete();
            }
            $imagen->delete();

            $this->imagenes = Imagen::all();

            $this->dispatch('alertaLivewire', "Eliminado");
        }
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $imagenes = Imagen::orderBy('created_at', 'desc')->paginate(30);

        return view('livewire.admin.imagen.imagen-todas-livewire', [
            'imagenes' => $imagenes,
        ]);
    }
}
