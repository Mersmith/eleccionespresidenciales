<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\CandidatoCargo;
use App\Models\CandidatoCargoEquipo;
use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Nivel;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoEquipoCrearLivewire extends Component
{
    use WithPagination;

    public int $liderId;
    public $lider;

    /* FILTROS */
    public $niveles;
    public $nivel_id = '';

    public $cargos;
    public $cargo_id = '';

    public $filtrarPorPartido = false;
    public $filtrarPorAlianza = false;

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $pais_id = '', $region_id = '', $provincia_id = '', $distrito_id = '';

    public $buscar = '';
    public $perPage = 20;

    /*protected $listeners = [
        'integranteEquipoQuitado' => '$refresh',
    ];*/

    public function mount($id)
    {
        $this->liderId = (int) $id;
        $this->niveles = Nivel::all();
        $this->paises = Pais::all();

        $this->lider = CandidatoCargo::with([
            'candidato', 'cargo', 'eleccion', 'equipo.integrante.candidato', 'equipo.integrante.cargo',
        ])->findOrFail($this->liderId);
    }

    public function updatedNivelId($value)
    {
        $this->resetPage();
        $this->cargo_id = '';
        $this->cargos = [];

        if ($value) {
            $this->cargos = Cargo::where('nivel_id', $value)->get();
        }
    }

    public function updatedCargoId()
    {
        $this->resetPage();
    }

    public function updatedFiltrarPorPartido()
    {
        $this->resetPage();
    }

    public function updatedFiltrarPorAlianza()
    {
        $this->resetPage();
    }

    public function updatedPaisId($value)
    {
        $this->resetPage();

        $this->region_id = "";
        $this->regiones = [];
        $this->provincia_id = "";
        $this->provincias = [];
        $this->distrito_id = "";
        $this->distritos = [];

        if ($value) {
            $this->loadRegiones();
        }
    }

    public function updatedRegionId($value)
    {
        $this->resetPage();

        $this->provincia_id = "";
        $this->provincias = [];
        $this->distritos = [];
        $this->distrito_id = "";

        if ($value) {
            $this->loadProvincias();
        }
    }

    public function updatedProvinciaId($value)
    {
        $this->resetPage();

        $this->distritos = [];
        $this->distrito_id = "";

        if ($value) {
            $this->loadDistritos();
        }
    }

    public function updatedDistritoId()
    {
        $this->resetPage();
    }

    public function loadRegiones()
    {
        if (!is_null($this->pais_id)) {
            $this->regiones = Region::where('pais_id', $this->pais_id)->get();
        }
    }

    public function loadProvincias()
    {
        if (!is_null($this->region_id)) {
            $this->provincias = Provincia::where('region_id', $this->region_id)->get();
        }
    }

    public function loadDistritos()
    {
        if (!is_null($this->provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $this->provincia_id)->get();
        }
    }

    public function updatedBuscar()
    {
        $this->resetPage();
    }

    // Acción: agregar integrante
    public function agregarIntegrante(int $integranteId)
    {
        if ($integranteId === $this->liderId) {
            return;
        }

        $exists = CandidatoCargoEquipo::where('lider_candidato_cargo_id', $this->liderId)
            ->where('integrante_candidato_cargo_id', $integranteId)
            ->exists();

        if ($exists) {
            //$this->dispatchBrowserEvent('toast', ['type' => 'warning', 'message' => 'Ya es integrante.']);
            return;
        }

        CandidatoCargoEquipo::create([
            'lider_candidato_cargo_id' => $this->liderId,
            'integrante_candidato_cargo_id' => $integranteId,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        //$this->dispatch('integranteEquipoAgregado', $this->liderId);
        //$this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => 'Integrante agregado.']);
        $this->resetPage();
    }

    public function render()
    { 
        // reconstruir query de posibles
        $query = CandidatoCargo::with(['candidato', 'cargo', 'partido'])
            ->where('eleccion_id', $this->lider->eleccion_id)
            ->where('id', '!=', $this->liderId);

        // **CORRECCIÓN**: usar liderId para obtener integrantes existentes
        $integrantesIds = CandidatoCargoEquipo::where('lider_candidato_cargo_id', $this->liderId)
            ->pluck('integrante_candidato_cargo_id')
            ->toArray();

        if (!empty($integrantesIds)) {
            $query->whereNotIn('id', $integrantesIds);
        }

        if ($this->filtrarPorPartido && $this->lider->partido_id) {
            $query->where('partido_id', $this->lider->partido_id);
        }

        if ($this->filtrarPorAlianza && $this->lider->alianza_id) {
            $query->where('alianza_id', $this->lider->alianza_id);
        }

        if (!empty($this->nivel_id)) {
            $query->where('nivel_id', $this->nivel_id);
        }

        if (!empty($this->cargo_id)) {
            $query->where('cargo_id', (int) $this->cargo_id);
        }

        if (!empty($this->pais_id)) {
            $query->where('pais_id', $this->pais_id);
        }

        if (!empty($this->region_id)) {
            $query->where('region_id', $this->region_id);
        }

        if (!empty($this->provincia_id)) {
            $query->where('provincia_id', $this->provincia_id);
        }

        if (!empty($this->distrito_id)) {
            $query->where('distrito_id', $this->distrito_id);
        }

        if (!empty($this->buscar)) {
            $query->whereHas('candidato', fn($q) => $q->where('nombre', 'like', '%' . $this->buscar . '%'));
        }

        $posibles = $query->orderBy('cargo_id')->paginate($this->perPage);
        return view('livewire.admin.candidato.candidato-cargo-equipo-crear-livewire', compact('posibles'));
    }
}
