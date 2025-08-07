<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\CandidatoCargo;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoTodasLivewire extends Component
{
    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-todas-livewire');
    }
}
