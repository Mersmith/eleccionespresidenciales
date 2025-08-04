<?php

namespace App\Livewire\Admin\Alianza;

use App\Models\Alianza;
use App\Models\Eleccion;
use App\Models\Partido;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CrearAlianzaLivewire extends Component
{
    public $nombre, $slug, $sigla, $descripcion, $logo, $activo = "0";
    public $eleccion_id;
    public $partidosSeleccionados = [];

    public $elecciones, $partidos;

    protected $rules = [
        'nombre' => 'required|string|unique:alianzas,nombre',
        'sigla' => 'nullable|string',
        'descripcion' => 'nullable|string',
        'eleccion_id' => 'required|exists:eleccions,id',
        'partidosSeleccionados' => 'required|array|min:1',
    ];

    public function mount()
    {
        $this->elecciones = Eleccion::all();
        $this->partidos = Partido::all();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function crearAlianza()
    {
        $this->validate();

        $alianza = Alianza::create([
            'nombre' => $this->nombre,
            'slug' => Str::slug($this->nombre),
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'eleccion_id' => $this->eleccion_id,
            'activo' => true,
            // 'logo' => ... si manejas subida de archivo, agregar aquí
        ]);

        $alianza->partidos()->attach($this->partidosSeleccionados);

        $this->dispatch('alertaLivewire', "Creado");

        // Reset o redireccionar
        $this->reset(['nombre', 'sigla', 'descripcion', 'eleccion_id', 'partidosSeleccionados']);
    }

    public function render()
    {
        return view('livewire.admin.alianza.crear-alianza-livewire');
    }
}
