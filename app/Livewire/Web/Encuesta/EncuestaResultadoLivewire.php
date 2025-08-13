<?php

namespace App\Livewire\Web\Encuesta;

use App\Models\Banner;
use App\Models\Encuesta;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Anuncio;

#[Layout('components.layouts.web.layout-ecommerce')]
class EncuestaResultadoLivewire extends Component
{
    public Encuesta $encuesta;

    public $data_baner_1;
    public $anuncios;

    public function mount($id)
    {
        $this->encuesta = Encuesta::with([
            'candidatoEncuestas.candidatoCargo.candidato',
            'votos',
        ])->findOrFail($id);

        $this->data_baner_1 = $this->getWebBanner(6);

        $this->anuncios = $this->getAnunciosPorAuspiciadorPagina();
        //dd($this->encuesta);
    }

    public function getWebBanner($id)
    {
        $banner = Banner::where('id', $id)
            ->where('activo', true)
            ->first();

        return $banner;
    }

    public function getAnunciosPorAuspiciadorPagina()
    {
        $now = Carbon::now();

        $anuncios = Anuncio::whereNotNull('auspiciador_id')
            ->where('pagina', 'resultado')
            ->where('activo', 1)
            ->where(function ($query) use ($now) {
                // Validar que no haya vencido
                $query->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', $now);
            })
            ->get();

        return $anuncios;
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
                'numero' => $candidatoCargo->numero,
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
