<?php

namespace App\Http\Controllers\Web\Encuesta;

use App\Http\Controllers\Controller;
use App\Models\Encuesta;

class WebEncuestaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $encuesta = $this->getWebEncuesta($id);

        $estado_encuesta = !$encuesta->activo
        || $encuesta->estado === 'finalizada'
        || $encuesta->ya_finalizo;
        //dd($encuesta);

        return view(
            'web.encuesta.index',
            compact(
                'encuesta',
                'estado_encuesta',
            )
        );
    }

    public function getWebEncuesta($id)
    {
        $encuesta = Encuesta::with('candidatoCargos.candidato')->findOrFail($id);

        return $encuesta;
    }
}
