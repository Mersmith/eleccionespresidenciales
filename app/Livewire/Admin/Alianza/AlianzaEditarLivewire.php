<?php

namespace App\Livewire\Admin\Alianza;

use App\Models\Alianza;
use App\Models\Eleccion;
use App\Models\Partido;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class AlianzaEditarLivewire extends Component
{
    public $alianza;

    public $nombre;
    public $slug;
    public $sigla;
    public $descripcion;
    public $logo;
    public $plan_gobierno;
    public $activo;

    public $redes_sociales;

    public $eleccion_id;
    public $partidosSeleccionados = [];

    public $elecciones, $partidos;

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:alianzas,nombre,' . $this->alianza->id,
            'slug' => 'required|unique:alianzas,slug,' . $this->alianza->id,
            'sigla' => 'nullable',
            'descripcion' => 'nullable|min:3|max:255',
            'logo' => 'nullable|url',
            'plan_gobierno' => 'nullable|url',
            'eleccion_id' => 'required',
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount($id)
    {
        $this->alianza = Alianza::findOrFail($id);

        $this->nombre = $this->alianza->nombre;
        $this->slug = $this->alianza->slug;
        $this->sigla = $this->alianza->sigla;
        $this->descripcion = $this->alianza->descripcion;
        $this->logo = $this->alianza->logo;
        $this->plan_gobierno = $this->alianza->plan_gobierno;
        $this->activo = $this->alianza->activo;
        $this->eleccion_id = $this->alianza->eleccion_id;

        $this->redes_sociales = json_decode($this->alianza->redes_sociales, true);


        $this->elecciones = Eleccion::all();
        $this->partidos = Partido::all();

        $this->partidosSeleccionados = $this->alianza->partidos()->pluck('partido_id')->toArray();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function actualizarAlianza()
    {
        $this->validate();

        $this->alianza->update([
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'sigla' => $this->sigla,
            'descripcion' => $this->descripcion,
            'logo' => $this->logo,
            'plan_gobierno' => $this->plan_gobierno,
            'activo' => $this->activo,
            'eleccion_id' => $this->eleccion_id,
        ]);

        // Sincronizar los partidos seleccionados
        $this->alianza->partidos()->sync($this->partidosSeleccionados);

        $this->dispatch('alertaLivewire', "Actualizado");

    }

    public function render()
    {
        return view('livewire.admin.alianza.alianza-editar-livewire');
    }
}
