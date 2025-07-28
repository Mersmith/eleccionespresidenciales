<?php

namespace App\Livewire\Web\Header;

use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Component;

class WebHeaderLivewire extends Component
{
    public $tipo_eleccion_id = null;
    public $eleccion_id = null;

    public $cargos;
    public $cargo_id = null;
    public $cargo_nivel_id = null;

    public $regiones;
    public $region_id = null;

    public $provincias = [];
    public $provincia_id = null;

    public $distritos = [];

    public function mount()
    {
        $this->cargos = Cargo::all();
    }

    public function seleccionarCargo($cargo_id)
    {
        $cargo = Cargo::find($cargo_id);

        if ($cargo->tipo_eleccion_id == 1) {
            $this->eleccion_id = 1;
            $this->tipo_eleccion_id = 1;
        } elseif ($cargo->tipo_eleccion_id == 2) {
            $this->eleccion_id = 2;
            $this->tipo_eleccion_id = 2;
        }

        $this->cargo_id = $cargo_id;
        $this->cargo_nivel_id = $cargo->nivel_id;

        return redirect()->route('encuestas', [
            'tipoEleccionSeleccionada' => $this->tipo_eleccion_id,
            'eleccionSeleccionada' => $this->eleccion_id,
            'cargoSeleccionada' => $this->cargo_id,
        ]);

        /*$this->regiones = Region::join('encuestas', 'regions.id', '=', 'encuestas.region_id')
            ->where('encuestas.eleccion_id', $this->eleccion_id)
            ->where('encuestas.nivel_id', $this->cargo_nivel_id)
            ->where('encuestas.cargo_id', $this->cargo_id)
            ->select('regions.id', 'regions.nombre')
            ->distinct()
            ->orderBy('regions.nombre')
            ->get();*/
    }

    public function seleccionarRegion($region_id)
    {
        $this->region_id = $region_id;

        $this->provincias = Provincia::join('encuestas', 'provincias.id', '=', 'encuestas.provincia_id')
            ->where('encuestas.eleccion_id', $this->eleccion_id)
            ->where('encuestas.nivel_id', $this->cargo_nivel_id)
            ->where('encuestas.cargo_id', $this->cargo_id)
            ->where('encuestas.region_id', $this->region_id)
            ->select('provincias.id', 'provincias.nombre')
            ->distinct()
            ->orderBy('provincias.nombre')
            ->get();
    }

    public function seleccionarProvincia($provincia_id)
    {
        $this->provincia_id = $provincia_id;

        $this->distritos = Distrito::join('encuestas', 'distritos.id', '=', 'encuestas.distrito_id')
            ->where('encuestas.eleccion_id', $this->eleccion_id)
            ->where('encuestas.nivel_id', $this->cargo_nivel_id)
            ->where('encuestas.cargo_id', $this->cargo_id)
            ->where('encuestas.provincia_id', $this->provincia_id)
            ->select('distritos.id', 'distritos.nombre')
            ->distinct()
            ->orderBy('distritos.nombre')
            ->get();
    }

    public function render()
    {
        return view('livewire.web.header.web-header-livewire');
    }
}
