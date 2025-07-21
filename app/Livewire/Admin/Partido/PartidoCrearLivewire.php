<?php

namespace App\Livewire\Admin\Partido;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Partido;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoCrearLivewire extends Component
{
    public $nombre, $sigla, $logo;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'sigla' => 'sigla',
        'logo' => 'logo',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:partidos,nombre',
            'sigla' => 'required',
            'logo' => 'required',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'sigla.required' => 'El :attribute es obligatorio.',

        'logo.required' => 'El :attribute es obligatorio.',
    ];

    public function crearPartido()
    {
        $this->validate();      

        Partido::create([
            'nombre' => $this->nombre,
            'sigla' =>$this->sigla,
            'logo' =>$this->logo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.partido.vista.todas');
    }
       
    public function render()
    {
        return view('livewire.admin.partido.partido-crear-livewire');
    }
}
