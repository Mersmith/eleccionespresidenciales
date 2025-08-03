<?php

namespace App\Livewire\Admin\Imagen;

use App\Models\Imagen;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\On;

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
        'imagen_edit' => 'nullable|image|max:2048',//JPEG, PNG, BMP, GIF, SVG, o WEBP //2048 kilobytes (2 MB)
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
        foreach ($this->imagenes_final as $imagen) {
            $path = $imagen->store('images', 'public');
            $url = Storage::url($path);

            Imagen::create([
                'titulo' => $this->titulo,
                'path' => $path,
                'url' => $url,
                'descripcion' => $this->descripcion,
            ]);
        }

        $this->reset();
        $this->imagenes = Imagen::all();
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
        $imagen->titulo = $this->titulo;

        if ($this->imagen_edit) {
            Storage::delete($imagen->path);
            $path = $this->imagen_edit->store('images', 'public');
            $url = Storage::url($path);
            $imagen->path = $path;
            $imagen->url = $url;
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
        Storage::delete($imagen->path);
        $imagen->delete();
        $this->imagenes = Imagen::all();

        $this->dispatch('alertaLivewire', "Eliminado");
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
