<?php

namespace App\Livewire;

use App\Models\Candidato;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class CandidatoEditar extends Component
{
    public $candidato;
    public $nombre, $descripcion, $foto;

    public function mount($id)
    {
        $this->candidato = Candidato::findOrFail($id);
        $this->nombre = $this->candidato->nombre;
        $this->descripcion = $this->candidato->descripcion;
        $this->foto = $this->candidato->foto;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
        ]);

        $this->candidato->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
        ]);

        return redirect()->route('candidato.lista');
    }

    public function delete()
    {
        $this->candidato->delete();
        return redirect()->route('candidato.lista');
    }

    public function render()
    {
        return view('livewire.candidato-editar');
    }
}
