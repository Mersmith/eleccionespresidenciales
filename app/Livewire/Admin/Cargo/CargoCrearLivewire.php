<?php

namespace App\Livewire\Admin\Cargo;

use App\Models\Cargo;
use App\Models\TipoEleccion;
use App\Models\Nivel;
use App\Models\Eleccion;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CargoCrearLivewire extends Component
{
    public $niveles,  $tipo_elecciones;

    public $nombre;
    public $nivel_id = '';
    public $tipo_eleccion_id = "";

    protected $validationAttributes = [
        'nivel_id' => 'nivel de elección',
        'nombre' => 'nombre del cargo',
        'tipo_eleccion_id' => 'elección asociada',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:cargos,nombre',
            'nivel_id' => 'required|exists:nivels,id',
            'tipo_eleccion_id' => 'required|exists:tipo_eleccions,id',
        ];
    }

    protected $messages = [
        'nivel_id.required' => 'La :attribute es obligatoria.',
        'nivel_id.exists' => 'La :attribute seleccionada no es válida.',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'tipo_eleccion_id.required' => 'La :attribute es obligatoria.',
        'tipo_eleccion_id.exists' => 'La :attribute seleccionada no es válida.',
    ];

    public function mount()
    {
        $this->niveles = Nivel::all();
        $this->tipo_elecciones = TipoEleccion::all();
    }

    public function crearCargo()
    {
        $this->validate();

        Cargo::create([
            'nombre' => $this->nombre,
            'nivel_id' => $this->nivel_id,
            'tipo_eleccion_id' => $this->tipo_eleccion_id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-crear-livewire');
    }
}
