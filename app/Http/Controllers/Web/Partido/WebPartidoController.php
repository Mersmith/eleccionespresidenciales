<?php

namespace App\Http\Controllers\Web\Partido;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Encuesta;
use App\Models\Partido;

class WebPartidoController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $partido = $this->getWebPartido($id);

        $candidatos_presidenciales = $this->getWebPartidoCandidatoPresidencial($id);

        $candidatos_alcaldia_lima = $this->getWebPartidoCandidatoAlcaldiaLima($id);

        $encuesta_presidencial_activa = $this->getWebPartidoEncuestaPresidencialActiva($id);

        //dd($encuesta_presidencial_activa);

        return view(
            'web.partido.index',
            compact(
                'partido',//ok
                'candidatos_presidenciales',//ok
                'candidatos_alcaldia_lima',
                'encuesta_presidencial_activa',
            )
        );
    }

    public function getWebPartido($id)
    {
        $partido = Partido::findOrFail($id);

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

        return $encuesta_activa;
    }
}
