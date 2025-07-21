<?php

namespace App\Livewire\Admin\Cargo;

use App\Models\Cargo;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CargoEditarLivewire extends Component
{
    public $cargoId;
    public $nivel;
    public $nombre;

    protected $validationAttributes = [
        'nivel' => 'tipo elección',
        'nombre' => 'nombre elección',
    ];

    protected function rules()
    {
        return [
            'nivel' => 'required|in:nacional,regional,provincial,distrital',
            'nombre' => 'required|unique:cargos,nombre,' . $this->cargoId,
        ];
    }

    protected $messages = [
        'nivel.required' => 'El :attribute es obligatorio.',
        'nivel.in' => 'El tipo de elección debe ser "nacional", "regional", "provincial" o "distrital".',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',
    ];

    public function mount($id)
    {
        $this->cargoId = $id;
        $cargo = Cargo::findOrFail($id);

        $this->nivel = $cargo->nivel;
        $this->nombre = $cargo->nombre;
    }

    public function actualizarCargo()
    {
        $this->validate();

        $cargo = Cargo::findOrFail($this->cargoId);
        $cargo->update([
            'nivel' => $this->nivel,
            'nombre' => $this->nombre,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-editar-livewire');
    }
}
