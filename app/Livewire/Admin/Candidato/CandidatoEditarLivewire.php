<?php

namespace App\Livewire\Admin\Candidato;

use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Distrito;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Plan;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class CandidatoEditarLivewire extends Component
{
    public $candidato;

    public $partidos;
    public $regiones = [], $provincias = [], $distritos = [];
    public $planes = [];

    public $nombre;
    public $slug;
    public $descripcion;
    public $foto;
    public $video_presentacion;
    public $plan_gobierno;
    public $partido_id;
    public $plan_id;
    public $region_id;
    public $provincia_id;
    public $distrito_id;
    public $candidato_oficial;
    public $activo;

    public $historial = [];

    public $redes_sociales;

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
            'nombre' => 'required|unique:candidatos,nombre,' . $this->candidato->id,
            'slug' => 'required|unique:candidatos,slug,' . $this->candidato->id,
            'descripcion' => 'required|min:3|max:255',
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

    public function mount($id)
    {
        $this->candidato = Candidato::findOrFail($id);

        $this->nombre = $this->candidato->nombre;
        $this->slug = $this->candidato->slug;
        $this->descripcion = $this->candidato->descripcion;
        $this->foto = $this->candidato->foto;
        $this->video_presentacion = $this->candidato->video_presentacion;
        $this->plan_gobierno = $this->candidato->plan_gobierno;
        $this->partido_id = $this->candidato->partido_id ?? '';
        $this->plan_id = $this->candidato->plan_id ?? '';
        $this->region_id = $this->candidato->region_id ?? '';
        $this->provincia_id = $this->candidato->provincia_id ?? '';
        $this->distrito_id = $this->candidato->distrito_id ?? '';
        $this->candidato_oficial = $this->candidato->candidato_oficial;
        $this->activo = $this->candidato->activo;

        $this->partidos = Partido::all();
        $this->regiones = Region::all();

        $this->loadProvincias();
        $this->loadDistritos();

        $this->cargarHistorial();

        $this->planes = Plan::all();

        $this->redes_sociales = json_decode($this->candidato->redes_sociales, true);
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

    public function actualizarPartido()
    {
        $this->validate();

        $this->candidato->update([
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
            'candidato_oficial' => $this->activo,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.candidato.vista.todas');
    }

    public function cargarHistorial()
    {
        $this->historial = CandidatoCargo::with(['cargo', 'eleccion', 'partido', 'region', 'provincia', 'distrito'])
            ->where('candidato_id', $this->candidato->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.candidato.candidato-editar-livewire');
    }
}
