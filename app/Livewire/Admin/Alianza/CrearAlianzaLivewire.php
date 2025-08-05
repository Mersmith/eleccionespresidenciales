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
    public $nombre, $slug, $sigla, $descripcion, $logo, $plan_gobierno, $activo = "0";
    public $eleccion_id;
    public $partidosSeleccionados = [];

    public $elecciones, $partidos;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'sigla' => 'sigla',
        'descripcion' => 'descripción',
        'logo' => 'logo',
        'plan_gobierno' => 'plan de gobierno',
        'eleccion_id' => 'elección',
        'activo' => 'estado',
    ];

    protected $rules = [
        'nombre' => 'required|string|unique:alianzas,nombre',
        'slug' => 'required|unique:alianzas,slug',
        'sigla' => 'nullable|string',
        'descripcion' => 'nullable|string',
        'logo' => 'nullable|url',
        'plan_gobierno' => 'nullable|url',
        'eleccion_id' => 'required|exists:eleccions,id',
        'activo' => 'required|numeric|regex:/^\d{1}$/',
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
            'logo' => $this->logo,
            'plan_gobierno' => $this->plan_gobierno,
            'eleccion_id' => $this->eleccion_id,
            'activo' => true,
        ]);

        $alianza->partidos()->attach($this->partidosSeleccionados);

        $this->dispatch('alertaLivewire', "Creado");

        $this->reset(['nombre', 'sigla', 'descripcion', 'eleccion_id', 'partidosSeleccionados']);

        return redirect()->route('admin.alianza.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.alianza.crear-alianza-livewire');
    }
}
