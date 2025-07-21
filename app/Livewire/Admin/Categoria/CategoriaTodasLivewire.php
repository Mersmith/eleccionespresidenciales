<?php

namespace App\Livewire\Admin\Categoria;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

#[Layout('components.layouts.admin.layout-admin')]
class CategoriaTodasLivewire extends Component
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
        $categorias = Categoria::where('nombre', 'like', '%' . $this->buscar . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('livewire.admin.categoria.categoria-todas-livewire', [
            'categorias' => $categorias,
        ]);
    }
}
