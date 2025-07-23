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

    public $buscar = '';
    public $perPage = 10;

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $elecciones = Eleccion::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.eleccion.eleccion-todas-livewire', compact('elecciones'));
    }
}
