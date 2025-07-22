<?php

namespace App\Livewire\Admin\Encuesta;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Encuesta;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaTodasLivewire extends Component
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
        $encuestas = Encuesta::where('titulo', 'like', '%' . $this->buscar . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('livewire.admin.encuesta.encuesta-todas-livewire', [
            'encuestas' => $encuestas,
        ]);
    }
}
