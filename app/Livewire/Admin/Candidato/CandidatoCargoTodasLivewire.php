<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Alianza;
use App\Models\CandidatoCargo;
use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Eleccion;
use App\Models\Nivel;
use App\Models\Pais;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoTodasLivewire extends Component
{
    use WithPagination;

    public $niveles;
    public $nivel_id = '';

    public $elecciones;
    public $eleccion_id = "";

    public $cargos;
    public $cargo_id = '';

    public $partidos;
    public $partido_id = "";

    public $alianzas;
    public $alianza_id = "";

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $pais_id = '', $region_id = '', $provincia_id = '', $distrito_id = '';

    public $activo = '';

    public $buscar = '';
    public $perPage = 20;

    public function mount()
    {
        $this->niveles = Nivel::all();
        $this->paises = Pais::all();
        $this->partidos = Partido::all();
        $this->alianzas = Alianza::where('activo', true)->get();
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

    public function updatedCargoId($value)
    {
        $this->resetPage();
        $cargo = Cargo::find($value);

        $this->eleccion_id = '';
        $this->elecciones = [];

        if ($value) {
            $this->elecciones = Eleccion::where('tipo_eleccion_id', $cargo->tipo_eleccion_id)->get();
        }
    }

    public function updatedEleccionId($value)
    {
        $this->resetPage();
    }

    public function updatedPartidoId($value)
    {
        $this->resetPage();
    }

    public function updatedAlianzaId($value)
    {
        $this->resetPage();
    }

    public function updatedActivo()
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

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = CandidatoCargo::query();

        // Filtro por numero
        if (!empty($this->buscar)) {
            $query->where(function ($q) {
                $q->where('numero', 'like', '%' . $this->buscar . '%')
                  ->orWhereHas('candidato', function ($qc) {
                      $qc->where('nombre', 'like', '%' . $this->buscar . '%');
                  });
            });
        }

        // Filtro por nivel
        if (!empty($this->nivel_id)) {
            $query->where('nivel_id', $this->nivel_id);
        }

        // Filtro por cargo
        if (!empty($this->cargo_id)) {
            $query->where('cargo_id', $this->cargo_id);
        }

        // Filtro por eleccion
        if (!empty($this->eleccion_id)) {
            $query->where('eleccion_id', $this->eleccion_id);
        }

        // Filtro por partido
        if (!empty($this->partido_id)) {
            $query->where('partido_id', $this->partido_id);
        }

        // Filtro por alianza
        if (!empty($this->alianza_id)) {
            $query->where('alianza_id', $this->alianza_id);
        }

        // Filtro por pais
        if (!empty($this->pais_id)) {
            $query->where('pais_id', $this->pais_id);
        }

        // Filtro por región
        if (!empty($this->region_id)) {
            $query->where('region_id', $this->region_id);
        }

        // Filtro por provincia
        if (!empty($this->provincia_id)) {
            $query->where('provincia_id', $this->provincia_id);
        }

        // Filtro por distrito
        if (!empty($this->distrito_id)) {
            $query->where('distrito_id', $this->distrito_id);
        }

        // Filtro por activo
        if ($this->activo !== '') {
            $query->where('activo', $this->activo);
        }

        $candito_cargos = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.candidato.candidato-cargo-todas-livewire', compact('candito_cargos'));
    }
}
