<?php

namespace App\Livewire\Admin\Membresia;

use App\Models\Membresia;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class MembresiaAuspiciadorHistorialLivewire extends Component
{
    use WithPagination;

    public $buscar = '';
    public $mesSeleccionado;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->mesSeleccionado = Carbon::now()->format('Y-m');
    }

    public function updatedBuscar()
    {
        $this->resetPage();
    }

    public function updatedMesSeleccionado()
    {
        $this->resetPage();
    }

    public function togglePagado($id)
    {
        $m = Membresia::findOrFail($id);
        $m->pagado = !$m->pagado;
        $m->save();

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    public function quitar($id)
    {
        Membresia::destroy($id);
        $this->dispatch('alertaLivewire', "Actualizado");
        $this->resetPage();
    }


    public function render()
    {
        $query = Membresia::with('auspiciador')
        ->whereNotNull('auspiciador_id') // Asegura que son de auspiciador
        ->when($this->buscar, function ($q) {
            $q->whereHas('auspiciador', fn($sub) =>
                $sub->where('nombre', 'like', '%' . $this->buscar . '%')
            );
        })
        ->when($this->mesSeleccionado, function ($q) {
            $q->whereMonth('mes', Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->month)
              ->whereYear('mes', Carbon::createFromFormat('Y-m', $this->mesSeleccionado)->year);
        })
        ->orderByDesc('mes');

        return view('livewire.admin.membresia.membresia-auspiciador-historial-livewire', [
            'historial' => $query->paginate(10),
        ]);
    }
}
