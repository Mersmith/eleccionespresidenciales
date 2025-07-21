<?php

namespace App\Livewire\Admin\Partido;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Partido;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoEditarLivewire extends Component
{
    public $partidoId;
    public $nombre;
    public $sigla;
    public $logo;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'sigla' => 'sigla',
        'logo' => 'logo',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:partidos,nombre,' . $this->partidoId,
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

    public function mount($id)
    {
        $this->partidoId = $id;
        $partido = Partido::findOrFail($id);

        $this->nombre = $partido->nombre;
        $this->sigla = $partido->sigla;
        $this->logo = $partido->logo;
    }

    public function actualizarPartido()
    {
        $this->validate();

        $partido = Partido::findOrFail($this->partidoId);
        $partido->update([
            'nombre' => $this->nombre,
            'sigla' => $this->sigla,
            'logo' => $this->logo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        return redirect()->route('admin.partido.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.partido.partido-editar-livewire');
    }
}
