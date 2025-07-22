<?php

namespace App\Livewire\Admin\Candidato;

use Livewire\Component;
use App\Models\CandidatoEncuesta;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoEncuestaLivewire extends Component
{
    public function render()
    {
        return view('livewire.admin.candidato.candidato-encuesta-livewire');
    }
}
