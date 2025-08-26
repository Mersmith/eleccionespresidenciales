<?php

namespace App\Livewire\Admin\Partido;

use App\Models\Partido;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class PartidoCrearLivewire extends Component
{
    public $nombre, $slug, $sigla, $descripcion, $logo, $plan_gobierno, $color = "#3498db", $activo = "0";

    protected $validationAttributes = [
        'nombre' => 'nombre',
        'slug' => 'slug',
        'sigla' => 'sigla',
        'descripcion' => 'descripción',
        'logo' => 'logo',
        'plan_gobierno' => 'plan de gobierno',
        'color' => 'color',
        'activo' => 'estado',
    ];

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:partidos,nombre',
            'slug' => 'required|unique:partidos,slug',
            'sigla' => 'nullable',
            'descripcion' => 'nullable|min:3|max:255',
            'logo' => 'nullable|url',
            'plan_gobierno' => 'nullable|url',
            'color' => 'nullable',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    } 

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function crearPartido()
    {
        $this->validate();

        Partido::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'logo' => $this->logo,
            'plan_gobierno' => $this->plan_gobierno,
            'color' => $this->color,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.partido.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.partido.partido-crear-livewire');
    }
}
