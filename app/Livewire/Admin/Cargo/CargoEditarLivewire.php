<?php

namespace App\Livewire\Admin\Cargo;

use App\Models\Cargo;
use App\Models\Eleccion;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CargoEditarLivewire extends Component
{
    public $elecciones;

    public $cargo;

    public $nombre;
    public $nivel;
    public $eleccion_id;

    protected $validationAttributes = [
        'nivel' => 'tipo elección',
        'nombre' => 'nombre elección',
        'eleccion_id' => 'elección asociada',
    ];

    protected function rules()
    {
        return [
            'nivel' => 'required|in:nacional,regional,provincial,distrital',
            'nombre' => 'required|unique:cargos,nombre,' . $this->cargo->id,
            'eleccion_id' => 'required|exists:eleccions,id',
        ];
    }

    protected $messages = [
        'nivel.required' => 'El :attribute es obligatorio.',
        'nivel.in' => 'El tipo de elección debe ser "nacional", "regional", "provincial" o "distrital".',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'eleccion_id.required' => 'La :attribute es obligatoria.',
        'eleccion_id.exists' => 'La :attribute seleccionada no es válida.',
    ];

    public function mount($id)
    {
        $this->cargo = Cargo::findOrFail($id);

        $this->nombre =  $this->cargo->nombre;
        $this->nivel =  $this->cargo->nivel;
        $this->eleccion_id =  $this->cargo->eleccion_id;

        $this->elecciones = Eleccion::all();

    }

    public function actualizarCargo()
    {
        $this->validate();

        $this->cargo->update([
            'nombre' => $this->nombre,
            'nivel' => $this->nivel,
            'eleccion_id' => $this->eleccion_id,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-editar-livewire');
    }
}
