<?php

namespace App\Http\Controllers\Web\Candidato;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Encuesta;
use App\Models\Post;
use Carbon\Carbon;

class WebCandidatoController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $candidato_partido = $this->getWebCandidatoPartido($id);

        $anuncios = $this->getAnunciosPorCandidatoOCasoAuspiciadores($id);

        $posts = $this->getPosts($id);

        $candidato_encuesta_activa = $this->getWebCandidatoEncuestaActiva($id);

        $candidato_cargos = $this->getWebCandidatoCargos($id);

        $candidato_encuestas_participaciones = $this->getWebCandidatoEncuestas($id);

        //dd($anuncios);

        return view(
            'web.candidato.index',
            compact(
                'candidato_partido', //ok
                'candidato_encuesta_activa', //ok
                'candidato_cargos', //ok
                'candidato_encuestas_participaciones', //ok
                'anuncios',
                'posts'
            )
        );
    }

    public function getWebCandidatoPartido($id)
    {
        $candidato_partido = Candidato::with('partido')->findOrFail($id);

        $candidato_partido->redes_sociales = json_decode($candidato_partido->redes_sociales, true);

        return $candidato_partido;
    }

    public function getWebCandidatoEncuestaActiva($id)
    {
        $encuesta_activa = Encuesta::where('estado', 'iniciada')
            ->where('activo', true)
            ->whereDate('fecha_fin', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_GENERAL'))
            ->whereHas('candidatoCargos', function ($q) use ($id) {
                $q->where('candidato_id', $id);
            })
            ->latest('fecha_inicio')
            ->first();

        if ($encuesta_activa) {
            $fecha_fin = Carbon::parse($encuesta_activa->fecha_fin);
            $dias_restantes = now()->diffInDays($fecha_fin);

            $encuesta_activa->dias = (int) $dias_restantes;

            return $encuesta_activa;
        }

        return null;
    }

    public function getWebCandidatoCargos($id)
    {
        $candidato_cargos = CandidatoCargo::with(['cargo', 'eleccion', 'partido', 'alianza', 'region', 'provincia', 'distrito'])
            ->where('candidato_id', $id)
            ->orderByDesc('created_at')
            ->get();

        return $candidato_cargos;
    }

    public function getWebCandidatoEncuestas($id)
    {
        $encuestas = Encuesta::whereHas('candidatoCargos', function ($q) use ($id) {
            $q->where('candidato_id', $id);
        })
            ->orderBy('fecha_inicio', 'desc')
            ->take(4)
            ->get();

        return $encuestas;
    }

    public function getAnunciosPorCandidatoOCasoAuspiciadores($candidato_id)
    {
        $now = Carbon::now();

        $anunciosCandidato = Anuncio::where('candidato_id', $candidato_id)
            ->where('activo', 1)
            ->where(function ($query) use ($now) {
                // Validar que no haya vencido
                $query->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', $now);
            })
            ->get();

        if ($anunciosCandidato->isEmpty()) {
            return Anuncio::whereNotNull('auspiciador_id')
                ->where('activo', 1)
                ->where(function ($query) use ($now) {
                    $query->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', $now);
                })
                ->get();
        }

        return $anunciosCandidato;
    }

    public function getPosts($candidato_id)
    {
        $titulo = 'Destacado';

        $posts = Post::where('candidato_id', $candidato_id)
            ->where('activo', 1)
            ->get();

        return [
            'id' => $candidato_id,
            'titulo' => $titulo,
            'posts' => $posts,
        ];       
    }

}
