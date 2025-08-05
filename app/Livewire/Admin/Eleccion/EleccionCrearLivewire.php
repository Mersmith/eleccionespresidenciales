<?php

namespace App\Livewire\Admin\Eleccion;

use App\Models\Eleccion;
use App\Models\TipoEleccion;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionCrearLivewire extends Component
{
    public $tipo_elecciones;

    #[Rule('required|unique:eleccions,nombre', as :'nombre de la elección')]
    public $nombre;

    #[Rule('required|unique:eleccions,slug', as :'slug')]
    public $slug;

    #[Rule('nullable|min:3|max:255', as :'descripción')]
    public $descripcion;

    #[Rule('required|exists:tipo_eleccions,id', as :'tipo de elección')]
    public $tipo_eleccion_id = '';

    #[Rule('nullable|url', as :'URL de la imagen')]
    public $imagen_ruta;

    #[Rule('required|date', as :'fecha de votación')]
    public $fecha_votacion;

    #[Rule('required|numeric|regex:/^\d{1}$/', as :'estado activo')]
    public $activo = "0";

    #[Rule('required|integer|min:2024|max:2100', as :'año')]
    public $anio;    

    public function mount()
    {
        $this->tipo_elecciones = TipoEleccion::all();
    }

    public function updatedTipoEleccionId()
    {
        $this->actualizarNombre();
    }

    public function updatedAnio()
    {
        $this->actualizarNombre();
        $this->reset('fecha_votacion');
    }

    public function actualizarNombre()
    {
        if ($this->tipo_eleccion_id && $this->anio) {
            $tipo_eleccion = TipoEleccion::find($this->tipo_eleccion_id);

            $this->nombre = strtoupper($tipo_eleccion->nombre) . ' ' . $this->anio;
            $this->slug = Str::slug($this->nombre);
        }
    }

    public function crearEleccion()
    {
        $this->actualizarNombre();

        $this->validate();

        Eleccion::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'tipo_eleccion_id' => $this->tipo_eleccion_id,
            'imagen_ruta' => $this->imagen_ruta,
            'fecha_votacion' => $this->fecha_votacion,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.eleccion.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.eleccion.eleccion-crear-livewire');
    }
}
