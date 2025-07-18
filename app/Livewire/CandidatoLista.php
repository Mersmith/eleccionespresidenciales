<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Candidato;

#[Layout('components.layouts.auth')]
class CandidatoLista extends Component
{
    public function render()
    {
        return view('livewire.candidato-lista', [
            'candidatos' => Candidato::with('encuestas')->get()
        ]);
    }
}
