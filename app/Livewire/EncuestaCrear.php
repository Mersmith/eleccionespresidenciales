<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Categoria;
use App\Models\Encuesta;

#[Layout('components.layouts.auth')]
class EncuestaCrear extends Component
{
    public $titulo;
    public $categoria_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $activa = true;

    public $categorias;

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function crearEncuesta()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Encuesta::create([
            'titulo' => $this->titulo,
            'categoria_id' => $this->categoria_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activa' => $this->activa,
        ]);

        session()->flash('mensaje', 'Encuesta creada correctamente.');
        $this->reset(['titulo', 'categoria_id', 'fecha_inicio', 'fecha_fin', 'activa']);
    }

    public function render()
    {
        return view('livewire.encuesta-crear');
    }
}
