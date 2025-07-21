<?php

namespace App\Livewire\Admin\Cargo;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cargo;

#[Layout('components.layouts.admin.layout-admin')]
class CargoTodasLivewire extends Component
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
        $cargos = Cargo::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.cargo.cargo-todas-livewire', [
            'cargos' => $cargos,
        ]);
    }
}
