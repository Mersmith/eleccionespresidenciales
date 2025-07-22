<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\Partido;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCrearLivewire extends Component
{
    public $nombre, $descripcion, $foto, $partido_id = "";
    public $partidos;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'descripcion' => 'descripción',
        'foto' => 'foto',
        'partido_id' => 'partido',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:candidatos,nombre',
            'descripcion' => 'required',
            'foto' => 'required',
            'partido_id' => 'required',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'descripcion.required' => 'El :attribute es obligatorio.',

        'foto.required' => 'El :attribute es obligatorio.',

        'partido_id.required' => 'El :attribute es obligatorio.',
    ];

    public function mount()
    {
        $this->partidos = Partido::all();
    }

    public function crearPartido()
    {
        $this->validate();

        Candidato::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
            'partido_id' => $this->partido_id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.candidato.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-crear-livewire');
    }
}
