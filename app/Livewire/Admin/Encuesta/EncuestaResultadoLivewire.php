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
        $this->encuesta = Encuesta::with([
            'candidatoEncuestas.candidatoCargo.candidato',
            'votos',
        ])->findOrFail($id);

        //dd($this->encuesta);
    }

    public function render()
    {
        $votosPorCandidato = $this->encuesta->votos
            ->groupBy('candidato_cargo_id')
            ->map->count();

        $resultados = $this->encuesta->candidatoEncuestas->map(function ($candidatoEncuesta) use ($votosPorCandidato) {
            $candidatoCargo = $candidatoEncuesta->candidatoCargo;
            return [
                'nombre' => $candidatoCargo->candidato->nombre,
                'votos' => $votosPorCandidato[$candidatoCargo->id] ?? 0,
            ];
        })->sortByDesc('votos')->values();

        // dd($resultados);

        return view('livewire.admin.encuesta.encuesta-resultado-livewire', [
            'resultados' => $resultados,
            'encuesta' => $this->encuesta,
        ]);
    }
}
