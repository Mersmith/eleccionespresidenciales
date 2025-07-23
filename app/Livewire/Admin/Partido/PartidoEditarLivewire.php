<?php

namespace App\Livewire\Admin\Partido;

use App\Models\Partido;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoEditarLivewire extends Component
{
    public $partido;

    public $nombre;
    public $slug;
    public $sigla;
    public $descripcion;
    public $logo;
    public $activo;

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
            'nombre' => 'required|unique:partidos,nombre,' . $this->partido->id,
            'slug' => 'required|unique:partidos,slug,' . $this->partido->id,
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

    public function mount($id)
    {
        $this->partido = Partido::findOrFail($id);

        $this->nombre = $this->partido->nombre;
        $this->slug = $this->partido->slug;
        $this->sigla = $this->partido->sigla;
        $this->descripcion = $this->partido->descripcion;
        $this->logo = $this->partido->logo;
        $this->activo = $this->partido->activo;
    }

    public function actualizarPartido()
    {
        $this->validate();

        $this->partido->update([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'logo' => $this->logo,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.partido.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.partido.partido-editar-livewire');
    }
}
