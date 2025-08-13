<?php

namespace App\Http\Controllers\Web\Encuesta;

use App\Http\Controllers\Controller;
use App\Models\Encuesta;
use App\Models\Banner;

class WebEncuestaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $encuesta = $this->getWebEncuesta($id);

        $data_baner_1 = $this->getWebBanner(5);

        $estado_encuesta = !$encuesta->activo
        || $encuesta->estado === 'finalizada'
        || $encuesta->ya_finalizo;
        //dd($encuesta);

        return view(
            'web.encuesta.index',
            compact(
                'encuesta',
                'estado_encuesta',
                'data_baner_1',
            )
        );
    }

    public function getWebEncuesta($id)
    {
        $encuesta = Encuesta::with('candidatoCargos.candidato')->findOrFail($id);

        return $encuesta;
    }

    public function getWebBanner($id)
    {
        $banner = Banner::where('id', $id)
            ->where('activo', true)
            ->first();

        return $banner;
    }
}
