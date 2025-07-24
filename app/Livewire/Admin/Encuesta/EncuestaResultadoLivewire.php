<?php

namespace App\Livewire\Admin\Encuesta;

use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class EncuestaResultadoLivewire extends Component
{
    public Encuesta $encuesta;

    public function mount($id)
    {
        $this->encuesta = Encuesta::with(['eleccion.candidatos', 'votos'])->findOrFail($id);
    }

    public function render()
    {
        $resultados = $this->encuesta->eleccion->candidatos->map(function ($candidato) {
            $votos = $candidato->votos()->where('encuesta_id', $this->encuesta->id)->count();
            return [
                'nombre' => $candidato->nombre,
                'votos' => $votos,
            ];
        })->sortByDesc('votos')->values();

        return view('livewire.admin.encuesta.encuesta-resultado-livewire', [
            'resultados' => $resultados,
        ]);
    }
}
