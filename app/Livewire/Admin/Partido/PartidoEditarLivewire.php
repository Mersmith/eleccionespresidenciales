<?php

namespace App\Livewire\Admin\Partido;

use App\Models\Partido;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoEditarLivewire extends Component
{
    public $partido;

    public $nombre;
    public $slug;
    public $sigla;
    public $descripcion;
    public $logo;
    public $plan_gobierno;
    public $activo;

    public $redes_sociales;

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'sigla' => 'sigla',
        'descripcion' => 'descripción',
        'logo' => 'logo',
        'plan_gobierno' => 'plan de gobierno',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:partidos,nombre,' . $this->partido->id,
            'slug' => 'required|unique:partidos,slug,' . $this->partido->id,
            'sigla' => 'nullable',
            'descripcion' => 'nullable|min:3|max:255',
            'logo' => 'nullable|url',
            'plan_gobierno' => 'nullable|url',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount($id)
    {
        $this->partido = Partido::findOrFail($id);

        $this->nombre = $this->partido->nombre;
        $this->slug = $this->partido->slug;
        $this->sigla = $this->partido->sigla;
        $this->descripcion = $this->partido->descripcion;
        $this->logo = $this->partido->logo;
        $this->plan_gobierno = $this->partido->plan_gobierno;
        $this->activo = $this->partido->activo;

        $this->redes_sociales = json_decode($this->partido->redes_sociales, true);
    }

    public function actualizarPartido()
    {
        $this->validate();

        $this->partido->update([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'logo' => $this->logo,
            'plan_gobierno' => $this->plan_gobierno,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('admin.partido.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.partido.partido-editar-livewire');
    }
}
