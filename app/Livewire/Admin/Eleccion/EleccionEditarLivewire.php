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
        'tipo_eleccion_id' => 'tipo de elección',
        'anio' => 'año',
        'nombre' => 'nombre de la elección',
        'slug' => 'slug',
        'descripcion' => 'descripción',
        'imagen_ruta' => 'URL de la imagen',
        'fecha_votacion' => 'fecha de votación',
        'activo' => 'estado activo',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:eleccions,nombre,' . $this->eleccion->id,
            'slug' => 'required|unique:eleccions,slug,' . $this->eleccion->id,
            'descripcion' => 'required|min:3|max:255',
            'tipo_eleccion_id' => 'required|exists:tipo_eleccions,id',
            'imagen_ruta' => 'nullable|url',
            'fecha_votacion' => 'required|date|after_or_equal:' . $this->anio . '-01-01|before_or_equal:' . $this->anio . '-12-31',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
            'anio' => 'required|integer|min:2024|max:2100',
        ];
    }

    protected $messages = [
        'tipo_eleccion_id.required' => 'La :attribute es obligatoria.',
        'tipo_eleccion_id.exists' => 'La :attribute seleccionada no es válida.',

        'anio.required' => 'El :attribute es obligatorio.',
        'anio.integer' => 'El :attribute debe ser un número entero.',
        'anio.min' => 'El :attribute no puede ser menor a 2024.',
        'anio.max' => 'El :attribute no puede ser mayor a 2100.',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'slug.required' => 'El :attribute es obligatorio.',
        'slug.unique' => 'El :attribute ya está registrado.',

        'descripcion.required' => 'La :attribute es obligatoria.',
        'descripcion.min' => 'La :attribute debe tener al menos :min caracteres.',
        'descripcion.max' => 'La :attribute no debe exceder los :max caracteres.',

        'imagen_ruta.url' => 'La :attribute debe ser una URL válida.',

        'fecha_votacion.required' => 'La :attribute es obligatoria.',
        'fecha_votacion.date' => 'La :attribute debe ser una fecha válida.',
        'fecha_votacion.after_or_equal' => 'La :attribute debe ser desde el 1 de enero del año seleccionado.',
        'fecha_votacion.before_or_equal' => 'La :attribute no puede ser después del 31 de diciembre del año seleccionado.',

        'activo.required' => 'El :attribute es obligatorio.',
        'activo.numeric' => 'El :attribute debe ser un número.',
        'activo.regex' => 'El :attribute debe ser 0 o 1.',

        'imagen_ruta.image' => 'La :attribute debe ser un archivo de imagen válido.',
    ];

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

    public function updatedTipo()
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
