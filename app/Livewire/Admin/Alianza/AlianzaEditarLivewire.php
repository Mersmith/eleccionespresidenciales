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
    public $activo;

    public $eleccion_id;
    public $partidosSeleccionados = [];

    public $elecciones, $partidos;

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:alianzas,nombre,' . $this->alianza->id,
            'slug' => 'required|unique:alianzas,slug,' . $this->alianza->id,
            'sigla' => 'required',
            'descripcion' => 'required|min:3|max:255',
            'logo' => 'required',
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
        $this->activo = $this->alianza->activo;
        $this->eleccion_id = $this->alianza->eleccion_id;

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
