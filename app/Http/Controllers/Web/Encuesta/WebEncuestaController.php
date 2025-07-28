<?php

namespace App\Http\Controllers\Web\Encuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Encuesta;

class WebEncuestaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $encuesta = $this->getWebEncuesta($id);

        //sdd($encuesta);

        return view(
            'web.encuesta.index',
            compact(
                'encuesta',
            )
        );
    }

    public function getWebEncuesta($id)
    {
        $encuesta = Encuesta::with('candidatoCargos.candidato')->findOrFail($id);

        return $encuesta;
    }
}
