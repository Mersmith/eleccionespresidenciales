<?php

namespace App\Livewire\Admin\Eleccion;

use App\Models\Eleccion;
use App\Models\TipoEleccion;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionEditarLivewire extends Component
{
    public $tipo_elecciones;

    public $eleccion;

    public $nombre;
    public $slug;
    public $descripcion;
    public $tipo_eleccion_id;
    public $imagen_ruta;
    public $fecha_votacion;
    public $activo;
    public $anio;

    protected $validationAttributes = [
        'nombre' => 'nombre de la elección',
        'slug' => 'slug',
        'descripcion' => 'descripción',
        'tipo_eleccion_id' => 'tipo de elección',
        'imagen_ruta' => 'URL de la imagen',
        'fecha_votacion' => 'fecha de votación',
        'activo' => 'estado activo',
        'anio' => 'año',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:eleccions,nombre,' . $this->eleccion->id,
            'slug' => 'required|unique:eleccions,slug,' . $this->eleccion->id,
            'descripcion' => 'nullable|min:3|max:255',
            'tipo_eleccion_id' => 'required|exists:tipo_eleccions,id',
            'imagen_ruta' => 'nullable|url',
            'fecha_votacion' => 'required|date|after_or_equal:' . $this->anio . '-01-01|before_or_equal:' . $this->anio . '-12-31',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
            'anio' => 'required|integer|min:2024|max:2100',
        ];
    }

    public function mount($id)
    {
        $this->tipo_elecciones = TipoEleccion::all();

        $this->eleccion = Eleccion::findOrFail($id);
        $this->nombre = $this->eleccion->nombre;
        $this->slug = $this->eleccion->slug;
        $this->descripcion = $this->eleccion->descripcion;
        $this->tipo_eleccion_id = $this->eleccion->tipo_eleccion_id;
        $this->imagen_ruta = $this->eleccion->imagen_ruta;
        $this->fecha_votacion = $this->eleccion->fecha_votacion;
        $this->activo = $this->eleccion->activo;

        $this->anio = date('Y', strtotime($this->eleccion->fecha_votacion));
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

    public function actualizarEleccion()
    {
        $this->actualizarNombre();

        $this->validate();

        $this->eleccion->update([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'tipo_eleccion_id' => $this->tipo_eleccion_id,
            'imagen_ruta' => $this->imagen_ruta,
            'fecha_votacion' => $this->fecha_votacion,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', 'Actualizado');
        //return redirect()->route('admin.eleccion.vista.todas');
    }
    public function render()
    {
        return view('livewire.admin.eleccion.eleccion-editar-livewire');
    }
}
