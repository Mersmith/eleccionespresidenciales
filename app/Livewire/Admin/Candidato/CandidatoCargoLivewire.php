<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Eleccion;
use App\Models\Nivel;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Pais;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoLivewire extends Component
{
    public $niveles;
    public $nivel_id = "";

    public $candidatoId;

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $cargos = [], $elecciones = [], $partidos;

    public $cargo_id = "", $eleccion_id = "", $partido_id = "";
    public $pais_id = "", $region_id = "", $provincia_id = "", $distrito_id = "";

    public $principal = "0";
    public $electo = "0";

    protected function rules()
    {
        return [
            'nivel_id' => 'required',
            'candidatoId' => 'required|exists:candidatos,id',
            'cargo_id' => 'required|exists:cargos,id',
            'eleccion_id' => 'required|exists:eleccions,id',
            'partido_id' => 'nullable|exists:partidos,id',
            'pais_id' => 'required_if:nivel_id,1|nullable|exists:pais,id',
            'region_id' => 'required_if:nivel_id,2|nullable|exists:regions,id',
            'provincia_id' => 'required_if:nivel_id,3|nullable|exists:provincias,id',
            'distrito_id' => 'required_if:nivel_id,4|nullable|exists:distritos,id',
            'principal' => 'required|numeric|regex:/^\d{1}$/',
            'electo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount($id)
    {
        $this->candidatoId = $id;
        $candidato = Candidato::findOrFail($id);
        $this->partido_id = $candidato->partido_id ?? '';

        $this->niveles = Nivel::all();
        $this->partidos = Partido::all();
        $this->paises = Pais::all();
    }

    public function updatedNivelId($value)
    {
        $this->cargo_id = '';
        $this->cargos = [];

        $this->pais_id = "";
        $this->region_id = "";
        $this->provincia_id = "";
        $this->distrito_id = "";

        if ($value) {
            $this->cargos = Cargo::where('nivel_id', $value)->get();
        }
    }

    public function updatedCargoId($value)
    {
        $cargo = Cargo::find($value);

        $this->eleccion_id = '';
        $this->elecciones = [];

        if ($value) {
            $this->elecciones = Eleccion::where('tipo_eleccion_id', $cargo->tipo_eleccion_id)->get();
        }
    }

    public function updatedPaisId($value)
    {
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

    public function crearEncuesta()
    {
        $this->validate();

        $pais_id = null;
        $region_id = null;
        $provincia_id = null;
        $distrito_id = null;

        if ($this->nivel_id == 1) {
            $pais_id = $this->pais_id;
        } elseif ($this->nivel_id == 2) {
            $region_id = $this->region_id;
        } elseif ($this->nivel_id == 3) {
            $provincia_id = $this->provincia_id;
        } elseif ($this->nivel_id == 4) {
            $distrito_id = $this->distrito_id;
        }

        $partido_id = $this->partido_id !== '' ? $this->partido_id : null;

        CandidatoCargo::create([
            'nivel_id' => $this->nivel_id,
            'candidato_id' => $this->candidatoId,
            'cargo_id' => $this->cargo_id,
            'eleccion_id' => $this->eleccion_id,
            'partido_id' => $partido_id,
            'pais_id' => $pais_id,
            'region_id' => $region_id,
            'provincia_id' => $provincia_id,
            'distrito_id' => $distrito_id,
            'principal' => $this->principal,
            'electo' => $this->electo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        //return redirect()->route('admin.candidato.vista.editar', $this->candidatoId);
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-livewire');
    }
}
