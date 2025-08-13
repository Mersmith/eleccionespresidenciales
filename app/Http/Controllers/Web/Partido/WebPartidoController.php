<?php

namespace App\Http\Controllers\Web\Partido;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Encuesta;
use App\Models\Partido;
use Carbon\Carbon;
use App\Models\Anuncio;

class WebPartidoController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $partido = $this->getWebPartido($id);

        $candidatos_presidenciales = $this->getWebPartidoAlianzaCandidatoPresidencial($id);

        $candidatos_alcaldia_lima = $this->getWebPartidoCandidatoAlcaldiaLima($id);

        $encuesta_presidencial_activa = $this->getWebPartidoEncuestaPresidencialActiva($id);

        $anuncios = $this->getAnunciosPorPartidoOCasoAuspiciadores($id);

        //dd($partido);

        return view(
            'web.partido.index',
            compact(
                'partido', //ok
                'candidatos_presidenciales', //ok
                'candidatos_alcaldia_lima', //ok
                'encuesta_presidencial_activa', //ok
                'anuncios'
            )
        );
    }

    public function getWebPartido($id)
    {
        $partido = Partido::with(['alianzas' => function ($query) {
            $query->where('eleccion_id', 1);
        }])->findOrFail($id);

        $partido->alianza = $partido->alianzas->first(); // añade la propiedad directamente

        return $partido;
    }

    public function getWebPartidoCandidatoPresidencial($id)
    {
        $cargo_id = 1; // presidente

        $candidatos = Candidato::whereHas('cargos', function ($query) use ($id, $cargo_id) {
            $query->where('partido_id', $id)
                ->where('cargo_id', $cargo_id);
        })->get();

        return $candidatos;
    }

    public function getWebPartidoAlianzaCandidatoPresidencial($partido_id)
    {
        $cargo_id = 1; // Presidente
        $eleccion_id = 1; // ID de elección actual (ajusta si es dinámico)

        // Buscar el partido con sus alianzas y los partidos de la alianza
        $partido = Partido::with(['alianzas' => function ($q) use ($eleccion_id) {
            $q->where('eleccion_id', $eleccion_id)->where('activo', true);
        }])->findOrFail($partido_id);

        $todosCandidatos = collect();

        // =========================
        // Candidatos por PARTIDO
        // =========================
        $candidatosPartido = Candidato::whereHas('cargos', function ($query) use ($partido_id, $cargo_id) {
            $query->where('partido_id', $partido_id)
                ->where('cargo_id', $cargo_id);
        })->get();

        $todosCandidatos = $todosCandidatos->merge($candidatosPartido);

        // =========================
        // Candidatos por ALIANZA
        // =========================
        if ($partido->alianzas->isNotEmpty()) {
            $alianza = $partido->alianzas->first(); // Si puede haber más de una activa, adapta esto

            $candidatosAlianza = Candidato::whereHas('cargos', function ($query) use ($alianza, $cargo_id) {
                $query->where('alianza_id', $alianza->id)
                    ->where('cargo_id', $cargo_id);
            })->get();

            $todosCandidatos = $todosCandidatos->merge($candidatosAlianza);
        }

        // =========================
        // Eliminar duplicados por ID
        // =========================
        return $todosCandidatos->unique('id')->values();
    }

    public function getWebPartidoCandidatoAlcaldiaLima($id)
    {
        $cargo_id = 9; // alcalde provincial

        $candidatos = Candidato::whereHas('cargos', function ($query) use ($id, $cargo_id) {
            $query->where('partido_id', $id)
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
                $q->where('partido_id', $id)
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

    public function getAnunciosPorPartidoOCasoAuspiciadores($partido_id)
    {
        $now = Carbon::now();

        $anunciosCandidato = Anuncio::where('partido_id', $partido_id)
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
}
