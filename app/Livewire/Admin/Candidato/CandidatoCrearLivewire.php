<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\Distrito;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Plan;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCrearLivewire extends Component
{
    public $partidos;
    public $regiones = [], $provincias = [], $distritos = [];
    public $planes = [];

    public $nombre;
    public $slug;
    public $descripcion;
    public $foto;
    public $video_presentacion;
    public $plan_gobierno;
    public $partido_id = "";
    public $plan_id = "";
    public $region_id = "";
    public $provincia_id = "";
    public $distrito_id = "";
    public $candidato_oficial = "0";
    public $activo = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'descripcion' => 'descripción',
        'foto' => 'foto',
        'video_presentacion' => 'video de presentación',
        'plan_gobierno' => 'plan de gobierno',
        'partido_id' => 'partido',
        'plan_id' => 'partido',
        'region_id' => 'región',
        'provincia_id' => 'provincia',
        'distrito_id' => 'distrito',
        'candidato_oficial' => 'candidato oficial',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:candidatos,nombre',
            'slug' => 'required|unique:candidatos,slug',
            'descripcion' => 'nullable|min:3|max:255',
            'foto' => 'nullable|url',
            'video_presentacion' => 'nullable|url',
            'plan_gobierno' => 'nullable|url',
            'partido_id' => 'nullable|exists:partidos,id',
            'plan_id' => 'required',
            'region_id' => 'required',
            'provincia_id' => 'required',
            'distrito_id' => 'required|exists:distritos,id',
            'candidato_oficial' => 'required|numeric|regex:/^\d{1}$/',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount()
    {
        $this->partidos = Partido::all();
        $this->regiones = Region::all();
        $this->planes = Plan::all();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
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

    public function crearPartido()
    {
        $this->validate();

        Candidato::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
            'video_presentacion' => $this->video_presentacion,
            'plan_gobierno' => $this->plan_gobierno,
            'partido_id' => $this->partido_id ?: null,
            'plan_id' => $this->plan_id,
            'region_id' => $this->region_id,
            'provincia_id' => $this->provincia_id,
            'distrito_id' => $this->distrito_id,
            'candidato_oficial' => $this->candidato_oficial,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.candidato.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-crear-livewire');
    }
}
