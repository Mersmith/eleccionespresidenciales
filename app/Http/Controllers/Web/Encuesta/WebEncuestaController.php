<?php

namespace App\Http\Controllers\Web\Encuesta;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Encuesta;
use Carbon\Carbon;
use App\Models\Anuncio;

class WebEncuestaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $encuesta = $this->getWebEncuesta($id);

        $data_baner_1 = $this->getWebBanner(5);

        $estado_encuesta = !$encuesta->activo
        || $encuesta->estado === 'finalizada'
        || $encuesta->ya_finalizo;

        $anuncios = $this->getAnunciosPorAuspiciadorPagina();

        //dd($encuesta);

        return view(
            'web.encuesta.index',
            compact(
                'encuesta',
                'estado_encuesta',
                'data_baner_1',
                'anuncios'
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

    public function getAnunciosPorAuspiciadorPagina()
    {
        $now = Carbon::now();

        $anuncios = Anuncio::whereNotNull('auspiciador_id')
            ->where('pagina', 'encuesta')
            ->where('activo', 1)
            ->where(function ($query) use ($now) {
                // Validar que no haya vencido
                $query->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', $now);
            })
            ->get();

        return $anuncios;
    }
}
