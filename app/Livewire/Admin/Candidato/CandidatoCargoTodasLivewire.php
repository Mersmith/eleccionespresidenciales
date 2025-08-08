<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\CandidatoCargo;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoTodasLivewire extends Component
{
    use WithPagination;

    public $buscar = '';
    public $activo = '';

    public $perPage = 20;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = CandidatoCargo::query();

        // Filtro por nombre
        if (!empty($this->buscar)) {
            $query->where('numero', 'like', '%' . $this->buscar . '%');
        }

        // Filtro por activo
        if ($this->activo !== '') {
            $query->where('activo', $this->activo);
        }

        $candito_cargos = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.candidato.candidato-cargo-todas-livewire', compact('candito_cargos'));
    }
}
