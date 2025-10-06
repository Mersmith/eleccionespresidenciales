<?php

namespace App\Livewire\Admin\Eleccion;

use App\Models\Alianza;
use App\Models\Eleccion;
use App\Models\Partido;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class EleccionPartidoAlianzaLivewire extends Component
{
    use WithPagination;

    public $eleccionId;
    public $eleccion;

    public string $searchDisponibles = '';
    public string $searchAgregados = '';

    public function mount($id)
    {
        $this->eleccionId = $id;
        $this->eleccion = Eleccion::findOrFail($id);
    }

    public function updatingSearchDisponibles()
    {
        $this->resetPage('pageDisponibles');
    }

    public function updatingSearchAgregados()
    {
        $this->resetPage('pageAgregados');
    }

    public function agregar($id, $tipo)
    {
        if ($tipo === 'partido') {
            $this->eleccion->partidos()->syncWithoutDetaching([
                $id => ['activo' => true],
            ]);
        } elseif ($tipo === 'alianza') {
            $this->eleccion->alianzas()->syncWithoutDetaching([
                $id => ['activo' => true],
            ]);
        }

        $this->dispatch('alertaLivewire', "Agregado correctamente");
    }

    public function quitar($id, $tipo)
    {
        if ($tipo === 'partido') {
            $this->eleccion->partidos()->detach($id);
        } elseif ($tipo === 'alianza') {
            $this->eleccion->alianzas()->detach($id);
        }

        $this->dispatch('alertaLivewire', "Eliminado correctamente");
    }

    private function paginarColeccion(Collection $items, $perPage, $pageName)
    {
        $page = request()->query($pageName, 1);
        $offset = ($page - 1) * $perPage;
        return new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['pageName' => $pageName]
        );
    }

    public function render()
    {
        // === AGREGADOS ===
        $partidosAgregados = $this->eleccion->partidos()
            ->where('partidos.nombre', 'like', "%{$this->searchAgregados}%")
            ->get()
            ->map(fn($p) => ['id' => $p->id, 'nombre' => $p->nombre, 'tipo' => 'partido']);

        $alianzasAgregadas = $this->eleccion->alianzas()
            ->where('alianzas.nombre', 'like', "%{$this->searchAgregados}%")
            ->get()
            ->map(fn($a) => ['id' => $a->id, 'nombre' => $a->nombre, 'tipo' => 'alianza']);

        $agregados = $partidosAgregados->concat($alianzasAgregadas)
            ->sortBy('nombre')
            ->values();

        $agregadosPaginados = $this->paginarColeccion($agregados, 30, 'pageAgregados');

        // === DISPONIBLES ===
        $partidosDisponibles = Partido::whereNotIn('id', $this->eleccion->partidos->pluck('id'))
            ->where('nombre', 'like', "%{$this->searchDisponibles}%")
            ->get()
            ->map(fn($p) => ['id' => $p->id, 'nombre' => $p->nombre, 'tipo' => 'partido']);

        $alianzasDisponibles = Alianza::whereNotIn('id', $this->eleccion->alianzas->pluck('id'))
            ->where('nombre', 'like', "%{$this->searchDisponibles}%")
            ->get()
            ->map(fn($a) => ['id' => $a->id, 'nombre' => $a->nombre, 'tipo' => 'alianza']);

        $disponibles = $partidosDisponibles->concat($alianzasDisponibles)
            ->sortBy('nombre')
            ->values();

        $disponiblesPaginados = $this->paginarColeccion($disponibles, 30, 'pageDisponibles');

        return view('livewire.admin.eleccion.eleccion-partido-alianza-livewire', [
            'agregados' => $agregadosPaginados,
            'disponibles' => $disponiblesPaginados,
        ]);
    }
}
