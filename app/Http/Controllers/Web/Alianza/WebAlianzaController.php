<?php

namespace App\Http\Controllers\Web\Alianza;

use App\Http\Controllers\Controller;
use App\Models\Alianza;
use App\Models\Candidato;
use App\Models\Encuesta;
use Carbon\Carbon;

class WebAlianzaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $alianza = $this->getWebAlianza($id);

        $candidatos_presidenciales = $this->getWebPartidoCandidatoPresidencial($id);

        $encuesta_presidencial_activa = $this->getWebPartidoEncuestaPresidencialActiva($id);

        return view(
            'web.alianza.index',
            compact(
                'alianza', //ok
                'candidatos_presidenciales', //ok
                'encuesta_presidencial_activa', //ok
            )
        );
    }

    public function getWebAlianza($id)
    {
        $alianza = Alianza::with('partidos')->findOrFail($id);

        return $alianza;
    }

    public function getWebPartidoCandidatoPresidencial($id)
    {
        $cargo_id = 1; // presidente

        $candidatos = Candidato::whereHas('cargos', function ($query) use ($id, $cargo_id) {
            $query->where('alianza_id', $id)
                ->where('cargo_id', $cargo_id);
        })->get();

        return $candidatos;
    }

    public function getWebPartidoEncuestaPresidencialActiva($id)
    {
        $cargo_id = 1; // presidente

        $encuesta_activa = Encuesta::where('estado', 'iniciada')
            ->where('activo', true)
            ->whereDate('fecha_inicio', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_GENERAL'))
            ->whereDate('fecha_fin', '>=', now())
            ->whereHas('candidatoCargos', function ($q) use ($id, $cargo_id) {
                $q->where('alianza_id', $id)
                    ->where('cargo_id', $cargo_id);
            })
            ->latest('fecha_inicio')
            ->first();

        if ($encuesta_activa) {
            $fecha_fin = Carbon::parse($encuesta_activa->fecha_fin);
            $dias_restantes = now()->diffInDays($fecha_fin);

            $encuesta_activa->dias = (int) $dias_restantes;

            return $encuesta_activa;
        }

        return $encuesta_activa;
    }

}
