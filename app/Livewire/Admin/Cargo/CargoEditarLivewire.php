<?php

namespace App\Livewire\Admin\Cargo;

use App\Models\Cargo;
use App\Models\Eleccion;
use App\Models\TipoEleccion;
use App\Models\Nivel;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CargoEditarLivewire extends Component
{
    public $niveles,  $tipo_elecciones;

    public $cargo;

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
            'nombre' => 'required|unique:cargos,nombre,' . $this->cargo->id,
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

    public function mount($id)
    {
        $this->cargo = Cargo::findOrFail($id);

        $this->nombre =  $this->cargo->nombre;
        $this->nivel_id =  $this->cargo->nivel_id;
        $this->tipo_eleccion_id =  $this->cargo->tipo_eleccion_id;

        $this->niveles = Nivel::all();
        $this->tipo_elecciones = TipoEleccion::all();

    }

    public function actualizarCargo()
    {
        $this->validate();

        $this->cargo->update([
            'nombre' => $this->nombre,
            'nivel_id' => $this->nivel_id,
            'tipo_eleccion_id' => $this->tipo_eleccion_id,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-editar-livewire');
    }
}
