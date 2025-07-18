<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Candidato;

#[Layout('components.layouts.auth')]
class CandidatoCrear extends Component
{
    public $nombre, $descripcion, $foto;

    public function save()
    {
        $this->validate([
            'nombre' => 'required',
        ]);

        Candidato::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
        ]);

        return redirect()->route('candidato.lista');
    }

    public function render()
    {
         return view('livewire.candidato-crear');
    }
}
