<?php

namespace App\Livewire\Web\Encuesta;

use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.web.layout-ecommerce')]
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
                'candidato_nombre' => $candidatoCargo->candidato->nombre,
                'candidato_foto' => $candidatoCargo->candidato->foto,
                'partido_nombre' => $candidatoCargo->partido ? $candidatoCargo->partido->nombre : ($candidatoCargo->alianza->nombre ?? 'Sin partido'),
                'partido_foto' => $candidatoCargo->partido ? $candidatoCargo->partido->logo : ($candidatoCargo->alianza->logo ?? null),
                'votos' => $votosPorCandidato[$candidatoCargo->id] ?? 0,
            ];
        })->sortByDesc('votos')->values();

        return view('livewire.web.encuesta.encuesta-resultado-livewire', [
            'resultados' => $resultados,
            'encuesta' => $this->encuesta,
        ]);
    }
}
