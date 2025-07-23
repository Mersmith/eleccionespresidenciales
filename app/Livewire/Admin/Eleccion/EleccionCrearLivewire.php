<?php

namespace App\Livewire\Admin\Eleccion;

use App\Models\Eleccion;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionCrearLivewire extends Component
{
    public $nombre;
    public $slug;
    public $descripcion;
    public $tipo = 'generales';
    public $imagen_ruta;
    public $fecha_votacion;
    public $activo = "0";
    public $anio;

    protected $validationAttributes = [
        'tipo' => 'tipo de elección',
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
            'nombre' => 'required|unique:eleccions,nombre',
            'slug' => 'required|unique:eleccions,slug',
            'descripcion' => 'required|min:3|max:255',
            'tipo' => 'required|in:generales,regionales_y_municipales',
            'imagen_ruta' => 'nullable|url',
            'fecha_votacion' => 'required|date|after_or_equal:' . $this->anio . '-01-01|before_or_equal:' . $this->anio . '-12-31',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
            'anio' => 'required|integer|min:2024|max:2100',
        ];
    }

    protected $messages = [
        'tipo.required' => 'El :attribute es obligatorio.',
        'tipo.in' => 'El :attribute debe ser "generales" o "regionales y municipales".',

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
        if ($this->tipo && $this->anio) {
            $tipo_formateado = Str::of($this->tipo)->replace('_', ' ')->upper();
            $this->nombre = 'ELECCIONES ' . $tipo_formateado . ' ' . $this->anio;
            $this->slug = Str::slug($this->nombre);
        }
    }

    public function crearEleccion()
    {
        $this->actualizarNombre();

        $this->validate();

        if ($this->tipo === 'generales') {
            $tipo_db = 'GENERALES';
        } elseif ($this->tipo === 'regionales_y_municipales') {
            $tipo_db = 'REGIONALES Y MUNICIPALES';
        } else {
            $tipo_db = null;
        }

        Eleccion::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'tipo' => $tipo_db,
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
