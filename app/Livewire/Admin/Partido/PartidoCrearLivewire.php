<?php

namespace App\Livewire\Admin\Partido;

use App\Models\Partido;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoCrearLivewire extends Component
{
    public $nombre, $slug, $sigla, $descripcion, $logo, $activo = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'sigla' => 'sigla',
        'descripcion' => 'descripción',
        'logo' => 'logo',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:partidos,nombre',
            'slug' => 'required|unique:partidos,slug',
            'sigla' => 'required',
            'descripcion' => 'required|min:3|max:255',
            'logo' => 'required',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'slug.required' => 'El :attribute es obligatorio.',
        'slug.unique' => 'El :attribute ya está registrado.',

        'sigla.required' => 'La :attribute es obligatoria.',

        'descripcion.required' => 'La :attribute es obligatoria.',
        'descripcion.min' => 'La :attribute debe tener al menos :min caracteres.',
        'descripcion.max' => 'La :attribute no debe exceder los :max caracteres.',

        'logo.required' => 'El :attribute es obligatorio.',

        'activo.required' => 'El :attribute es obligatorio.',
        'activo.numeric' => 'El :attribute debe ser un valor numérico.',
        'activo.regex' => 'El :attribute debe ser 1 (activo) o 0 (inactivo).',
    ];

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function crearPartido()
    {
        $this->validate();

        Partido::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'logo' => $this->logo,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.partido.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.partido.partido-crear-livewire');
    }
}
