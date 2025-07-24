<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Cargo;
use App\Models\Categoria;
use App\Models\Distrito;
use App\Models\TipoEleccion;
use App\Models\Eleccion;
use App\Models\Encuesta;
use App\Models\Nivel;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaCrearLivewire extends Component
{
    public $niveles;
    public $nivel_id = "";

    public $paises = [], $regiones = [], $provincias = [], $distritos = [];
    public $categorias, $elecciones, $cargos = [];

    public $nombre;
    public $slug;
    public $descripcion;
    public $imagen_url;
    public $categoria_id = "";
    public $eleccion_id = "";
    public $cargo_id = "";
    public $pais_id = "";
    public $region_id = "";
    public $provincia_id = "";
    public $distrito_id = "";
    public $fecha_inicio;
    public $fecha_fin;
    public $estado = "pendiente";
    public $activo = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'descripcion' => 'descripción',
        'imagen_url' => 'URL de imagen',
        'categoria_id' => 'categoría',
        'eleccion_id' => 'elección',
        'cargo_id' => 'cargo',
        'region_id' => 'región',
        'provincia_id' => 'provincia',
        'distrito_id' => 'distrito',
        'fecha_inicio' => 'fecha de inicio',
        'fecha_fin' => 'fecha de fin',
        'estado' => 'estado',
        'activo' => 'estado activo',
    ];

    protected function rules()
    {
        return [
            'nivel_id' => 'required',
            'nombre' => 'required|unique:encuestas,nombre',
            'slug' => 'required|unique:encuestas,slug',
            'descripcion' => 'required|min:3|max:255',
            'imagen_url' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id',
            'eleccion_id' => 'required|exists:eleccions,id',
            'cargo_id' => 'required|exists:cargos,id',
            'pais_id' => 'required_if:nivel_id,1|nullable|exists:pais,id',
            'region_id' => 'required_if:nivel_id,2|nullable|exists:regions,id',
            'provincia_id' => 'required_if:nivel_id,3|nullable|exists:provincias,id',
            'distrito_id' => 'required_if:nivel_id,4|nullable|exists:distritos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,iniciada,finalizada',
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
        'descripcion.max' => 'La :attribute no debe superar los :max caracteres.',

        'imagen_url.url' => 'La :attribute debe ser una URL válida.',

        'categoria_id.required' => 'La :attribute es obligatoria.',
        'categoria_id.exists' => 'La :attribute seleccionada no es válida.',

        'eleccion_id.required' => 'La :attribute es obligatoria.',
        'eleccion_id.exists' => 'La :attribute seleccionada no es válida.',

        'cargo_id.required' => 'El :attribute es obligatorio.',
        'cargo_id.exists' => 'El :attribute seleccionado no es válido.',

        'region_id.required' => 'La :attribute es obligatoria.',
        'provincia_id.required' => 'La :attribute es obligatoria.',

        'distrito_id.required' => 'El :attribute es obligatorio.',
        'distrito_id.exists' => 'El :attribute seleccionado no es válido.',

        'fecha_inicio.required' => 'La :attribute es obligatoria.',
        'fecha_inicio.date' => 'La :attribute no tiene un formato válido.',

        'fecha_fin.required' => 'La :attribute es obligatoria.',
        'fecha_fin.date' => 'La :attribute no tiene un formato válido.',
        'fecha_fin.after_or_equal' => 'La :attribute debe ser igual o posterior a la fecha de inicio.',

        'estado.required' => 'El :attribute es obligatorio.',
        'estado.in' => 'El :attribute debe ser una de las siguientes opciones: pendiente, iniciada o finalizada.',

        'activo.required' => 'El :attribute es obligatorio.',
        'activo.numeric' => 'El :attribute debe ser un número.',
        'activo.regex' => 'El :attribute debe ser 0 o 1.',
    ];

    public function mount()
    {
        $this->niveles = Nivel::all();
        $this->categorias = Categoria::all();
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

        $this->actualizarNombre();
    }

    public function updatedEleccionId($value)
    {
        $this->actualizarNombre();
    }

    public function updatedFechaInicio($value)
    {
        $this->actualizarNombre();
    }

    public function updatedFechaFin($value)
    {
        $this->actualizarNombre();
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

    public function actualizarNombre()
    {
        if ($this->eleccion_id && $this->cargo_id && $this->fecha_inicio && $this->fecha_fin) {
            $eleccion = Eleccion::find($this->eleccion_id);
            $cargo = Cargo::find($this->cargo_id);

            $fechaInicio = Carbon::parse($this->fecha_inicio)->format('d-m-Y');
            $fechaFin = Carbon::parse($this->fecha_fin)->format('d-m-Y');

            $this->nombre = 'ENCUESTA ' . strtoupper($eleccion->nombre) . ' - ' . strtoupper($cargo->nombre) . ' - del ' . $fechaInicio . ' al ' . $fechaFin;
            $this->slug = Str::slug($this->nombre);
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

        Encuesta::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'imagen_url' => $this->imagen_url,
            'categoria_id' => $this->categoria_id,
            'nivel_id' => $this->nivel_id,
            'cargo_id' => $this->cargo_id,
            'eleccion_id' => $this->eleccion_id,
            'pais_id' => $pais_id,
            'region_id' => $region_id,
            'provincia_id' => $provincia_id,
            'distrito_id' => $distrito_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado' => $this->estado,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.encuesta.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.encuesta.encuesta-crear-livewire');
    }
}
