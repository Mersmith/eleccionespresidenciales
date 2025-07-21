<?php

namespace App\Livewire\Admin\Eleccion;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Eleccion;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionTodasLivewire extends Component
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
        $elecciones = Eleccion::where('nombre', 'like', '%' . $this->buscar . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('livewire.admin.eleccion.eleccion-todas-livewire', [
            'elecciones' => $elecciones,
        ]);
    }
}
