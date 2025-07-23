<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Eleccion;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoLivewire extends Component
{
    public $candidatoId;

    public $cargos, $elecciones, $partidos;
    public $regiones = [], $provincias = [], $distritos = [];

    public $cargo_id = "", $eleccion_id = "", $partido_id = "";
    public $region_id = "", $provincia_id = "", $distrito_id = "";

    public function mount($id)
    {
        $this->candidatoId = $id;
        $candidato = Candidato::findOrFail($id);

        $this->elecciones = Eleccion::all();
        $this->partidos = Partido::all();
        $this->regiones = Region::all();
    }

    public function updatedEleccionId($value)
    {
        $this->cargo_id = '';
        $this->cargos = [];

        if ($value) {
            $this->cargos = Cargo::where('eleccion_id', $value)->get();
        }
    }

    public function updatedRegionId($value)
    {
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
        $this->distritos = [];
        $this->distrito_id = "";

        if ($value) {
            $this->loadDistritos();
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

    public function crearEncuesta()
    {

        CandidatoCargo::create([
            'candidato_id' => $this->candidatoId,
            'cargo_id' => $this->cargo_id,
            'eleccion_id' => $this->eleccion_id,
            'partido_id' => $this->partido_id,
            'region_id' => $this->region_id,
            'provincia_id' => $this->provincia_id,
            'distrito_id' => $this->distrito_id,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.candidato.vista.editar', $this->candidatoId);
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-livewire');
    }
}
