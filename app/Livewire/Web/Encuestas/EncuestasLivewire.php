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

#[Layout('components.layouts.web.layout-ecommerce')]
class EncuestasLivewire extends Component
{
    public $tipos_elecciones;
    public $tipoEleccionSeleccionada = null;

    public $elecciones;
    public $eleccionSeleccionada = null;

    public $cargos;
    public $cargoSeleccionada = null;
    public $cargoNivel = null;

    public $regiones;
    public $regionSeleccionada = null;

    public $provincias = [];
    public $provinciaSeleccionada = null;

    public $distritos = [];
    public $distritoSeleccionada = null;

    public $encuestas = [];

    public function mount()
    {

        $this->tipos_elecciones = TipoEleccion::all();
    }

    public function seleccionarTipoEleccion($tipo_eleccion_id)
    {
        $this->tipoEleccionSeleccionada = $tipo_eleccion_id;

        $this->elecciones = Eleccion::where('tipo_eleccion_id', $this->tipoEleccionSeleccionada)->get();
    }

    public function seleccionarEleccion($eleccion_id)
    {
        $this->eleccionSeleccionada = $eleccion_id;

        $this->cargos = Cargo::where('tipo_eleccion_id', $this->tipoEleccionSeleccionada)->get();
    }

    public function seleccionarCargo($cargo_id)
    {
        $this->cargoSeleccionada = $cargo_id;

        $cargo = Cargo::find($cargo_id);
        $this->cargoNivel = $cargo->nivel_id;

        if ($cargo) {
            $this->encuestas = $this->getEncuestas();
        }

        $this->regiones = Region::join('encuestas', 'regions.id', '=', 'encuestas.region_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->select('regions.id', 'regions.nombre')
            ->distinct()
            ->orderBy('regions.nombre')
            ->get();
    }

    public function seleccionarRegion($region_id)
    {
        $this->regionSeleccionada = $region_id;

        if ($region_id) {
            $this->encuestas = $this->getEncuestas();
        }

        $this->provincias = Provincia::join('encuestas', 'provincias.id', '=', 'encuestas.provincia_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->where('encuestas.region_id', $this->regionSeleccionada)
            ->select('provincias.id', 'provincias.nombre')
            ->distinct()
            ->orderBy('provincias.nombre')
            ->get();
    }

    public function seleccionarProvincia($provincia_id)
    {
        $this->provinciaSeleccionada = $provincia_id;

        if ($provincia_id) {
            $this->encuestas = $this->getEncuestas();
        }

        $this->distritos = Distrito::join('encuestas', 'distritos.id', '=', 'encuestas.distrito_id')
            ->where('encuestas.eleccion_id', $this->eleccionSeleccionada)
            ->where('encuestas.nivel_id', $this->cargoNivel)
            ->where('encuestas.cargo_id', $this->cargoSeleccionada)
            ->where('encuestas.provincia_id', $this->provinciaSeleccionada)
            ->select('distritos.id', 'distritos.nombre')
            ->distinct()
            ->orderBy('distritos.nombre')
            ->get();
    }

    public function seleccionarDistrito($distrito_id)
    {
        $this->distritoSeleccionada = $distrito_id;

        if ($distrito_id) {
            $this->encuestas = $this->getEncuestas();
        }

    }
    public function getEncuestas()
    {
        $encuestas = Encuesta::where('eleccion_id', $this->eleccionSeleccionada)
            ->where('nivel_id', $this->cargoNivel)
            ->where('cargo_id', $this->cargoSeleccionada)
            ->where('region_id', $this->regionSeleccionada)
            ->where('provincia_id', $this->provinciaSeleccionada)
            ->where('distrito_id', $this->distritoSeleccionada)
            ->take(5)
            ->get();

        return $encuestas;
    }

    public function render()
    {
        return view('livewire.web.encuestas.encuestas-livewire');
    }
}
