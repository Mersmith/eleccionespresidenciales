<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaTodasLivewire extends Component
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
        $encuestas = Encuesta::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.encuesta.encuesta-todas-livewire', compact('encuestas'));
    }
}
