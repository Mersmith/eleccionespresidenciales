<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\CandidatoCargo;
use App\Models\CandidatoCargoEquipo;
use App\Models\Cargo;
use App\Models\Nivel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoEquipoLivewire extends Component
{
    public CandidatoCargo $lider;
    public $posibles = [];
    public $seleccionados = []; // colección de pivot rows (CandidatoCargoEquipo)
    public $seleccionadosIds = []; // ids de los integrantes (candidato_cargo.id)

    /* FILTROS */
    public $niveles;
    public $nivel_id = "";

    public $cargos;
    public $cargo_id = "";

    public $filtrarPorPartido = false;
    public $filtrarPorAlianza = false;

    public function mount($id)
    {
        $this->niveles = Nivel::all();

        // eager load para tener equipo + relaciones ya disponibles
        $this->lider = CandidatoCargo::with(['candidato', 'cargo', 'eleccion', 'equipo.integrante.candidato', 'equipo.integrante.cargo'])->findOrFail($id);

        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    // cuando cambia el filtro: primero recargamos seleccionados (ids) y luego los posibles
    public function updatedNivelId($value)
    {
        $this->cargo_id = '';
        $this->cargos = [];

        if ($value) {
            $this->cargos = Cargo::where('nivel_id', $value)->get();
        }

        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    public function updatedCargoId()
    {
        // opcional: limpiar Seleccionados/Posibles si value es vacío
        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    public function updatedFiltrarPorPartido()
    {
        // primero recargar seleccionados (para calcular ids)
        $this->loadSeleccionados();
        // luego posibles (usa $this->seleccionadosIds)
        $this->loadPosibles();
    }

    public function updatedFiltrarPorAlianza()
    {
        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    protected function loadSeleccionados()
    {
        $query = $this->lider
            ->equipo() // hasMany pivot rows
            ->with(['integrante.candidato', 'integrante.cargo']);

        // filtrar por partido del integrante igual al del líder
        if ($this->filtrarPorPartido && $this->lider->partido_id) {
            $query->whereHas('integrante', function ($q) {
                $q->where('partido_id', $this->lider->partido_id);
            });
        }

        // filtrar por alianza del integrante igual a la del líder
        if ($this->filtrarPorAlianza && $this->lider->alianza_id) {
            $query->whereHas('integrante', function ($q) {
                $q->where('alianza_id', $this->lider->alianza_id);
            });
        }

        // Si se seleccionó un nivel, filtramos por el nivel del integrante
        if (!empty($this->nivel_id)) {
            $query->whereHas('integrante', function ($q) {
                $q->where('nivel_id', $this->nivel_id);
            });
        }

        // Si se seleccionó un cargo, filtramos por el cargo del integrante
        if (!empty($this->cargo_id)) {
            $query->whereHas('integrante', function ($q) {
                $q->where('cargo_id', $this->cargo_id);
            });
        }

        // colección de filas pivot (CandidatoCargoEquipo)
        $this->seleccionados = $query->get();

        // IDs para excluir en la consulta de posibles
        $this->seleccionadosIds = $this->seleccionados
            ->pluck('integrante_candidato_cargo_id')
            ->map(fn($v) => (int) $v)
            ->toArray();
    }

    protected function loadPosibles()
    {
        $query = CandidatoCargo::query()
            ->with(['candidato', 'cargo', 'partido'])
            ->where('eleccion_id', $this->lider->eleccion_id)
            ->where('id', '!=', $this->lider->id);

        // Excluir los que ya son integrantes del líder
        if (!empty($this->seleccionadosIds)) {
            $query->whereNotIn('id', $this->seleccionadosIds);
        }

        // FILTROS SIMPLES: comparar con el líder
        if ($this->filtrarPorPartido && $this->lider->partido_id) {
            $query->where('partido_id', $this->lider->partido_id);
        }

        if ($this->filtrarPorAlianza && $this->lider->alianza_id) {
            $query->where('alianza_id', $this->lider->alianza_id);
        }

        // Aplicar filtro de nivel (si se seleccionó uno)
        if (!empty($this->nivel_id)) {
            $query->where('nivel_id', $this->nivel_id);
        }

        // Aplicar filtro de cargo (si se seleccionó uno)
        if (!empty($this->cargo_id)) {
            $query->where('cargo_id', $this->cargo_id);
        }

        $this->posibles = $query->orderBy('cargo_id')->get();

    }

    public function agregarIntegrante(int $integranteId)
    {
        if ($integranteId === $this->lider->id) {
            return;
        }

        if (in_array($integranteId, $this->seleccionadosIds)) {
            return;
        }

        CandidatoCargoEquipo::create([
            'lider_candidato_cargo_id' => $this->lider->id,
            'integrante_candidato_cargo_id' => $integranteId,
        ]);

        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    public function removeIntegrante(int $integranteId)
    {
        CandidatoCargoEquipo::where('lider_candidato_cargo_id', $this->lider->id)
            ->where('integrante_candidato_cargo_id', $integranteId)
            ->delete();

        $this->loadSeleccionados();
        $this->loadPosibles();
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-equipo-livewire');
    }
}
