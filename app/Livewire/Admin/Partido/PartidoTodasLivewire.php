<?php

namespace App\Livewire\Admin\Partido;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Partido;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoTodasLivewire extends Component
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
        $partidos = Partido::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.partido.partido-todas-livewire', [
            'partidos' => $partidos,
        ]);
    }
}
