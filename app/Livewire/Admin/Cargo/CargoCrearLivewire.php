<?php

namespace App\Livewire\Admin\Cargo;

use App\Models\Cargo;
use App\Models\Eleccion;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CargoCrearLivewire extends Component
{
    public $elecciones;

    public $nombre;
    public $nivel = 'nacional';
    public $eleccion_id = "";

    protected $validationAttributes = [
        'nivel' => 'nivel de elección',
        'nombre' => 'nombre del cargo',
        'eleccion_id' => 'elección asociada',
    ];

    protected function rules()
    {
        return [
            'nivel' => 'required|in:nacional,regional,provincial,distrital',
            'nombre' => 'required|unique:cargos,nombre',
            'eleccion_id' => 'required|exists:eleccions,id',
        ];
    }

    protected $messages = [
        'nivel.required' => 'El :attribute es obligatorio.',
        'nivel.in' => 'El :attribute debe ser "nacional", "regional", "provincial" o "distrital".',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'eleccion_id.required' => 'La :attribute es obligatoria.',
        'eleccion_id.exists' => 'La :attribute seleccionada no es válida.',
    ];

    public function mount()
    {
        $this->elecciones = Eleccion::all();
    }

    public function crearCargo()
    {
        $this->validate();

        Cargo::create([
            'nombre' => $this->nombre,
            'nivel' => $this->nivel,
            'eleccion_id' => $this->eleccion_id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-crear-livewire');
    }
}
