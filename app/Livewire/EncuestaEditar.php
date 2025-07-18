<?php

namespace App\Livewire;

use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class EncuestaEditar extends Component
{
    public $encuestaId;
    public $titulo;
    public $categoria_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $activa;

    public function mount($id)
    {
        $encuesta = Encuesta::findOrFail($id);

        $this->encuestaId = $encuesta->id;
        $this->titulo = $encuesta->titulo;
        $this->categoria_id = $encuesta->categoria_id;
        $this->fecha_inicio = $encuesta->fecha_inicio;
        $this->fecha_fin = $encuesta->fecha_fin;
        $this->activa = $encuesta->activa;
    }

    public function actualizar()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $encuesta = Encuesta::findOrFail($this->encuestaId);

        $encuesta->update([
            'titulo' => $this->titulo,
            'categoria_id' => $this->categoria_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activa' => $this->activa,
        ]);

        session()->flash('message', 'Encuesta actualizada correctamente.');
    }

    public function eliminar()
    {
        Encuesta::findOrFail($this->encuestaId)->delete();

        return redirect()->route('encuesta.index')->with('message', 'Encuesta eliminada.');
    }

    public function render()
    {
        return view('livewire.encuesta-editar');
    }
}
