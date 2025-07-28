<?php

namespace App\Livewire\Web\Encuestas;

use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Eleccion;
use App\Models\Encuesta;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\TipoEleccion;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.web.layout-ecommerce')]
class EncuestasLivewire extends Component
{
    use WithPagination;

    protected $queryString = [
        'tipoEleccionSeleccionada' => ['except' => ''],
        'eleccionSeleccionada' => ['except' => ''],
        'cargoSeleccionada' => ['except' => ''],
        'regionSeleccionada' => ['except' => ''],
        'provinciaSeleccionada' => ['except' => ''],
        'distritoSeleccionada' => ['except' => ''],
    ];

    public $tipos_elecciones;
    public $tipoEleccionSeleccionada = '';

    public $elecciones = [];
    public $eleccionSeleccionada = '';

    public $cargos = [];
    public $cargoSeleccionada = '';
    public $cargoNivel = null;

    public $regiones = [];
    public $regionSeleccionada = '';

    public $provincias = [];
    public $provinciaSeleccionada = '';

    public $distritos = [];
    public $distritoSeleccionada = '';

    public function mount()
    {
        $this->tipos_elecciones = TipoEleccion::all();

        if ($this->tipoEleccionSeleccionada) {
            $this->actualizarElecciones();
        }
        if ($this->eleccionSeleccionada) {
            $this->actualizarCargos();
        }
        if ($this->cargoSeleccionada) {
            $this->actualizarRegiones();
        }
        if ($this->regionSeleccionada) {
            $this->actualizarProvincias();
        }
        if ($this->provinciaSeleccionada) {
            $this->actualizarDistritos();
        }
    }

    public function updatedTipoEleccionSeleccionada()
    {
        $this->reset(['eleccionSeleccionada', 'cargoSeleccionada', 'regionSeleccionada', 'provinciaSeleccionada', 'distritoSeleccionada']);
        $this->actualizarElecciones();
    }

    public function updatedEleccionSeleccionada()
    {
        $this->reset(['cargoSeleccionada', 'regionSeleccionada', 'provinciaSeleccionada', 'distritoSeleccionada']);
        $this->actualizarCargos();
    }

    public function updatedCargoSeleccionada()
    {
        $this->reset(['regionSeleccionada', 'provinciaSeleccionada', 'distritoSeleccionada']);
        $this->actualizarRegiones();
    }

    public function updatedRegionSeleccionada()
    {
        $this->reset(['provinciaSeleccionada', 'distritoSeleccionada']);
        $this->actualizarProvincias();
    }

    public function updatedProvinciaSeleccionada()
    {
        $this->reset(['distritoSeleccionada']);
        $this->actualizarDistritos();
    }

    public function actualizarElecciones()
    {
        $this->elecciones = Eleccion::where('tipo_eleccion_id', $this->tipoEleccionSeleccionada)->get();
    }

    public function actualizarCargos()
    {
        $this->cargos = Cargo::where('tipo_eleccion_id', $this->tipoEleccionSeleccionada)->get();
    }

    public function actualizarRegiones()
    {
        $cargo = Cargo::find($this->cargoSeleccionada);
        $this->cargoNivel = $cargo?->nivel_id;

        $this->regiones = Region::join('encuestas', 'regions.id', '=', 'encuestas.region_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->select('regions.id', 'regions.nombre')
            ->distinct()->orderBy('regions.nombre')
            ->get();
    }

    public function actualizarProvincias()
    {
        $this->provincias = Provincia::join('encuestas', 'provincias.id', '=', 'encuestas.provincia_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->where('encuestas.region_id', $this->regionSeleccionada)
            ->select('provincias.id', 'provincias.nombre')
            ->distinct()->orderBy('provincias.nombre')
            ->get();
    }

    public function actualizarDistritos()
    {
        $this->distritos = Distrito::join('encuestas', 'distritos.id', '=', 'encuestas.distrito_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->where('encuestas.provincia_id', $this->provinciaSeleccionada)
            ->select('distritos.id', 'distritos.nombre')
            ->distinct()->orderBy('distritos.nombre')
            ->get();
    }

    public function getEncuestasProperty()
    {
        return Encuesta::where('eleccion_id', $this->eleccionSeleccionada)
            ->when($this->cargoNivel, fn($q) => $q->where('nivel_id', $this->cargoNivel))
            ->when($this->cargoSeleccionada, fn($q) => $q->where('cargo_id', $this->cargoSeleccionada))
            ->when($this->regionSeleccionada, fn($q) => $q->where('region_id', $this->regionSeleccionada))
            ->when($this->provinciaSeleccionada, fn($q) => $q->where('provincia_id', $this->provinciaSeleccionada))
            ->when($this->distritoSeleccionada, fn($q) => $q->where('distrito_id', $this->distritoSeleccionada))
            ->paginate(5);
    }

    public function limpiarFiltros()
    {
        $this->tipoEleccionSeleccionada = null;
        $this->eleccionSeleccionada = null;
        $this->cargoSeleccionado = null;
        $this->regionSeleccionada = null;
        $this->provinciaSeleccionada = null;
        $this->distritoSeleccionada = null;
    
        $this->resetPage();

        return redirect()->route('encuestas');
    }

    public function render()
    {
        return view('livewire.web.encuestas.encuestas-livewire', [
            'encuestas' => $this->encuestas,
        ]);
    }
}
