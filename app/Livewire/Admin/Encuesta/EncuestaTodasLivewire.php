<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Encuesta;
use App\Models\Nivel;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaTodasLivewire extends Component
{
    use WithPagination;

    /* FILTROS */
    public $niveles;
    public $nivel_id = '';

    public $cargos;
    public $cargo_id = '';

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $pais_id = '', $region_id = '', $provincia_id = '', $distrito_id = '';

    public $activo = '';
    public $estado = '';

    public $fecha_inicio_desde = '';
    public $fecha_inicio_hasta = '';

    public $buscar = '';
    public $perPage = 20;

    public function mount()
    {
        $this->niveles = Nivel::all();
        $this->paises = Pais::all();
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

    public function updatedActivo()
    {
        $this->resetPage();
    }

    public function updatedEstado()
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
        $query = Encuesta::query();

        // Filtro por nombre
        if (!empty($this->buscar)) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%');
        }

        // Filtro por nivel
        if (!empty($this->nivel_id)) {
            $query->where('nivel_id', $this->nivel_id);
        }

        // Filtro por cargo
        if (!empty($this->cargo_id)) {
            $query->where('cargo_id', $this->cargo_id);
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

        // Filtro por estado
        if ($this->estado !== '') {
            $query->where('estado', $this->estado);
        }

        // Filtro por fecha_inicio entre rango
        if (!empty($this->fecha_inicio_desde) && !empty($this->fecha_inicio_hasta)) {
            $query->whereBetween('fecha_inicio', [
                $this->fecha_inicio_desde . ' 00:00:00',
                $this->fecha_inicio_hasta . ' 23:59:59',
            ]);
        }

        $encuestas = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.encuesta.encuesta-todas-livewire', compact('encuestas'));
    }
}
