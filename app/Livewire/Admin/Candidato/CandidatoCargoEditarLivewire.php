<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Alianza;
use App\Models\Candidato;
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

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCargoEditarLivewire extends Component
{
    public $candidato_cargo;

    public $niveles;
    public $nivel_id;

    public $candidato;
    public $candidatoId;

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $cargos = [], $elecciones = [], $partidos;

    public $alianza_id;
    public $alianzas = [];

    public $cargo_id, $eleccion_id, $partido_id;
    public $pais_id, $region_id, $provincia_id, $distrito_id;

    public $numero;

    public $principal;
    public $electo;
    public $activo;

    protected function rules()
    {
        return [
            'nivel_id' => 'required',
            'candidatoId' => 'required|exists:candidatos,id',
            'cargo_id' => 'required|exists:cargos,id',
            'eleccion_id' => 'required|exists:eleccions,id',
            'partido_id' => 'nullable|exists:partidos,id',
            'alianza_id' => 'nullable|exists:alianzas,id',
            'numero' => 'nullable',
            'pais_id' => 'required_if:nivel_id,1|nullable|exists:pais,id',
            'region_id' => 'required_if:nivel_id,2|nullable|exists:regions,id',
            'provincia_id' => 'required_if:nivel_id,3|nullable|exists:provincias,id',
            'distrito_id' => 'required_if:nivel_id,4|nullable|exists:distritos,id',
            'principal' => 'required|numeric|regex:/^\d{1}$/',
            'electo' => 'required|numeric|regex:/^\d{1}$/',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount($id)
    {
        $this->candidato_cargo = CandidatoCargo::findOrFail($id);

        $this->candidatoId = $this->candidato_cargo->candidato_id;
        $this->candidato = Candidato::findOrFail($this->candidatoId);
        $this->nivel_id = $this->candidato_cargo->nivel_id;
        $this->cargo_id = $this->candidato_cargo->cargo_id;
        $this->eleccion_id = $this->candidato_cargo->eleccion_id;
        $this->partido_id = $this->candidato_cargo->partido_id ?? '';
        $this->alianza_id = $this->candidato_cargo->alianza_id ?? '';
        $this->numero = $this->candidato_cargo->numero;
        $this->pais_id = $this->candidato_cargo->pais_id ?? '';
        $this->region_id = $this->candidato_cargo->region_id ?? '';
        $this->provincia_id = $this->candidato_cargo->provincia_id ?? '';
        $this->distrito_id = $this->candidato_cargo->distrito_id ?? '';
        $this->principal = $this->candidato_cargo->principal;
        $this->electo = $this->candidato_cargo->electo;
        $this->activo = $this->candidato_cargo->activo;

        $this->niveles = Nivel::all();
        $this->partidos = Partido::all();
        $this->paises = Pais::all();
        $this->alianzas = Alianza::where('activo', true)->get();

        if ($this->nivel_id) {
            $this->cargos = Cargo::where('nivel_id', $this->nivel_id)->get();
        }

        if ($this->cargo_id) {
            $cargo = Cargo::find($this->cargo_id);

            $this->elecciones = Eleccion::where('tipo_eleccion_id', $cargo->tipo_eleccion_id)->get();
        }

        if (!$this->pais_id && $this->region_id) {
            $this->pais_id = Region::find($this->region_id)?->pais_id;
        }

        if (!$this->region_id && $this->provincia_id) {
            $this->region_id = Provincia::find($this->provincia_id)?->region_id;
            $this->pais_id = Region::find($this->region_id)?->pais_id;
        }

        if (!$this->provincia_id && $this->distrito_id) {
            $this->provincia_id = Distrito::find($this->distrito_id)?->provincia_id;
            $this->region_id = Provincia::find($this->provincia_id)?->region_id;
            $this->pais_id = Region::find($this->region_id)?->pais_id;
        }

        $this->loadRegiones();
        $this->loadProvincias();
        $this->loadDistritos();
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

    public function updatedPaisId()
    {
        $this->region_id = "";
        $this->provincias = [];
        $this->provincia_id = "";
        $this->distritos = [];
        $this->distrito_id = "";
        $this->loadRegiones();
    }

    public function updatedRegionId()
    {
        $this->provincia_id = "";
        $this->distritos = [];
        $this->distrito_id = "";
        $this->loadProvincias();
    }

    public function updatedProvinciaId()
    {
        $this->distrito_id = "";
        $this->loadDistritos();
    }

    public function loadRegiones()
    {
        $this->regiones = Region::where('pais_id', $this->pais_id)->get();
    }

    public function loadProvincias()
    {
        $this->provincias = Provincia::where('region_id', $this->region_id)->get();
    }

    public function loadDistritos()
    {
        $this->distritos = Distrito::where('provincia_id', $this->provincia_id)->get();
    }

    public function actualizarCandidatoCargo()
    {
        $this->validate();       

        $this->candidato_cargo->update([
            'numero' => $this->numero,
            'principal' => $this->principal,
            'electo' => $this->electo,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.encuesta.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-cargo-editar-livewire');
    }
}
