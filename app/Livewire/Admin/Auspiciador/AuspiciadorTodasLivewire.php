<?php

namespace App\Livewire\Admin\Auspiciador;

use App\Models\Auspiciador;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class AuspiciadorTodasLivewire extends Component
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
        $auspiciadores = Auspiciador::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.auspiciador.auspiciador-todas-livewire', [
            'auspiciadores' => $auspiciadores,
        ]);
    }
}
