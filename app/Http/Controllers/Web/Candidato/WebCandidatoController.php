<?php

namespace App\Http\Controllers\Web\Candidato;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\CandidatoCargo;
use App\Models\Encuesta;
use Carbon\Carbon;

class WebCandidatoController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $candidato_partido = $this->getWebCandidatoPartido($id);

        $candidato_encuesta_activa = $this->getWebCandidatoEncuestaActiva($id);

        $candidato_cargos = $this->getWebCandidatoCargos($id);

        $candidato_encuestas_participaciones = $this->getWebCandidatoEncuestas($id);

        //dd($getWebCandidatoEncuestaActiva);

        return view(
            'web.candidato.index',
            compact(
                'candidato_partido',
                'candidato_encuesta_activa',
                'candidato_cargos',
                'candidato_encuestas_participaciones',
            )
        );
    }

    public function getWebCandidatoPartido($id)
    {
        $candidato_partido = Candidato::with('partido')->findOrFail($id);

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
        $candidato_cargos = CandidatoCargo::with(['cargo', 'eleccion', 'partido', 'region', 'provincia', 'distrito'])
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

}
