<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Encuesta;

#[Layout('components.layouts.auth')]
class EncuestaResultado extends Component
{
    public Encuesta $encuesta;

    public function mount($id)
    {
        $this->encuesta = Encuesta::with(['candidatos', 'votos'])->findOrFail($id);
    }

    public function render()
    {
        $resultados = $this->encuesta->candidatos->map(function ($candidato) {
            $votos = $candidato->votos()->where('encuesta_id', $this->encuesta->id)->count();
            return [
                'nombre' => $candidato->nombre,
                'votos' => $votos,
            ];
        })->sortByDesc('votos')->values(); // 👈 Ordena de mayor a menor

        return view('livewire.encuesta-resultado', [
            'resultados' => $resultados,
        ]);
    }
}
