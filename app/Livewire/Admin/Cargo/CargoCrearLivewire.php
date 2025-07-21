<?php

namespace App\Livewire\Admin\Cargo;

use Livewire\Component;
use App\Models\Cargo;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CargoCrearLivewire extends Component
{
    public $nivel = 'nacional';
    public $nombre;

    protected $validationAttributes = [
        'nivel' => 'tipo elección',
        'nombre' => 'nombre elección',
    ];

    protected function rules()
    {
        return [
            'nivel' => 'required|in:nacional,regional,provincial,distrital',
            'nombre' => 'required|unique:cargos,nombre',
        ];
    }

    protected $messages = [
        'nivel.required' => 'El :attribute es obligatorio.',
        'nivel.in' => 'El tipo de elección debe ser "nacional", "regional", "provincial" o "distrital".',

        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',
    ];
   
    public function crearCargo()
    {
        $this->validate();      

        Cargo::create([
            'nombre' => $this->nombre,
            'nivel' =>$this->nivel,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.cargo.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.cargo.cargo-crear-livewire');
    }
}
