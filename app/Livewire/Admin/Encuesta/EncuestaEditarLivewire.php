<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Cargo;
use App\Models\Categoria;
use App\Models\Distrito;
use App\Models\Encuesta;
use App\Models\Provincia;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaEditarLivewire extends Component
{
    public $encuestaId;

    public $regiones = [], $provincias = [], $distritos = [];
    public $categorias, $cargos;

    public $titulo, $categoria_id, $cargo_id;
    public $region_id, $provincia_id, $distrito_id;
    public $fecha_inicio, $fecha_fin;
    public $activa;

    protected function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'cargo_id' => 'required|exists:cargos,id',
            'region_id' => 'required',
            'provincia_id' => 'required',
            'distrito_id' => 'required|exists:distritos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activa' => 'boolean',
        ];
    }

    protected $validationAttributes = [
        'titulo' => 'título',
        'categoria_id' => 'categoría',
        'cargo_id' => 'cargo',
        'region_id' => 'región',
        'provincia_id' => 'provincia',
        'distrito_id' => 'distrito',
        'fecha_inicio' => 'fecha de inicio',
        'fecha_fin' => 'fecha de fin',
        'activa' => 'estado activa',
    ];

    protected $messages = [
        'titulo.required' => 'El :attribute es obligatorio.',
        'titulo.max' => 'El :attribute no debe superar los 255 caracteres.',
        'categoria_id.required' => 'La :attribute es obligatoria.',
        'categoria_id.exists' => 'La :attribute seleccionada no es válida.',
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
        'activa.boolean' => 'El campo :attribute debe ser verdadero o falso.',
    ];

    public function mount($id)
    {
        $this->encuestaId = $id;
        $encuesta = Encuesta::findOrFail($id);

        $this->titulo = $encuesta->titulo;
        $this->categoria_id = $encuesta->categoria_id;
        $this->cargo_id = $encuesta->cargo_id;
        $this->region_id = $encuesta->region_id;
        $this->provincia_id = $encuesta->provincia_id;
        $this->distrito_id = $encuesta->distrito_id;
        $this->fecha_inicio = $encuesta->fecha_inicio;
        $this->fecha_fin = $encuesta->fecha_fin;
        $this->activa = $encuesta->activa;

        $this->categorias = Categoria::all();
        $this->cargos = Cargo::all();

        $this->regiones = Region::all();
        $this->loadProvincias();
        $this->loadDistritos();
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

    public function loadProvincias()
    {
        $this->provincias = Provincia::where('region_id', $this->region_id)->get();
    }

    public function loadDistritos()
    {
        $this->distritos = Distrito::where('provincia_id', $this->provincia_id)->get();
    }

    public function actualizarEncuesta()
    {
        $this->validate();

        $encuesta = Encuesta::findOrFail($this->encuestaId);
        $encuesta->update([
            'titulo' => $this->titulo,
            'categoria_id' => $this->categoria_id,
            'cargo_id' => $this->cargo_id,
            'region_id' => $this->region_id,
            'provincia_id' => $this->provincia_id,
            'distrito_id' => $this->distrito_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activa' => $this->activa,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        return redirect()->route('admin.encuesta.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.encuesta.encuesta-editar-livewire');
    }
}
