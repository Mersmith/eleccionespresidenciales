<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\Distrito;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoCrearLivewire extends Component
{
    public $partidos;
    public $regiones = [], $provincias = [], $distritos = [];

    public $nombre;
    public $slug;
    public $descripcion;
    public $foto;
    public $partido_id = "";
    public $region_id = "";
    public $provincia_id = "";
    public $distrito_id = "";
    public $activo = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'descripcion' => 'descripción',
        'foto' => 'foto',
        'partido_id' => 'partido',
        'region_id' => 'región',
        'provincia_id' => 'provincia',
        'distrito_id' => 'distrito',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:candidatos,nombre',
            'slug' => 'required|unique:candidatos,slug',
            'descripcion' => 'required|min:3|max:255',
            'foto' => 'nullable|url',
            'partido_id' => 'nullable|exists:partidos,id',
            'region_id' => 'required',
            'provincia_id' => 'required',
            'distrito_id' => 'required|exists:distritos,id',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El :attribute es obligatorio.',
        'nombre.unique' => 'El :attribute ya está registrado.',

        'slug.required' => 'El :attribute es obligatorio.',
        'slug.unique' => 'El :attribute ya está registrado.',

        'descripcion.required' => 'La :attribute es obligatoria.',
        'descripcion.min' => 'La :attribute debe tener al menos :min caracteres.',
        'descripcion.max' => 'La :attribute no puede exceder :max caracteres.',

        'foto.url' => 'La :attribute debe ser una URL válida.',

        'partido_id.required' => 'El :attribute es obligatorio.',
        'partido_id.exists' => 'El :attribute seleccionado no es válido.',

        'region_id.required' => 'La :attribute es obligatoria.',
        'provincia_id.required' => 'La :attribute es obligatoria.',

        'distrito_id.required' => 'El :attribute es obligatorio.',
        'distrito_id.exists' => 'El :attribute seleccionado no es válido.',

        'activo.required' => 'El :attribute es obligatorio.',
        'activo.numeric' => 'El :attribute debe ser un número.',
        'activo.regex' => 'El :attribute debe ser 0 o 1.',
    ];

    public function mount()
    {
        $this->partidos = Partido::all();
        $this->regiones = Region::all();
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
            'partido_id' => $this->partido_id ?: null,
            'region_id' => $this->region_id,
            'provincia_id' => $this->provincia_id,
            'distrito_id' => $this->distrito_id,
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
