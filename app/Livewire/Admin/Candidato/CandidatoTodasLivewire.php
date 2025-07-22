<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoTodasLivewire extends Component
{
    use WithPagination;
    public $buscar;

    protected $paginate = 10;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $candidatos = Candidato::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.candidato.candidato-todas-livewire', [
            'candidatos' => $candidatos,
        ]);
    }
}
