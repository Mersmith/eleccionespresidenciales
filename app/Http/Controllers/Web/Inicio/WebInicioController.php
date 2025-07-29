<?php

namespace App\Http\Controllers\Web\Inicio;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CandidatoCargo;
use App\Models\Distrito;
use App\Models\Encuesta;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WebInicioController extends Controller
{
    public function __invoke()
    {
        $data_baner_1 = $this->getWebBanner(1);
        $data_banner_2 = $this->getWebBanner(2);

        $data_sliders_principal_1 = $this->getWebSlidersPrincipal(1);

        $data_candidatos_presidenciales = $this->getWebCandidatosPresidenciales();
        $data_candidatos_alcaldia_lima = $this->getWebCandidatosAlcaldiaLima();

        $data_partidos_politicos = $this->getWebpartidosPoliticos();

        $data_encuesta_presidencial = $this->getWebEncuestaPresidencial();
        $data_encuesta_alcaldia_provincial_lima = $this->getWebEncuestaAlcaldiaProvincialLima();

        $data_encuestas_alcaldia_distritos_lima = $this->getWebEncuestasAlcaldiaDistritosLima();

        //dd($data_encuestas_alcaldia_distritos_lima);

        return view(
            'web.inicio.index',
            compact(
                'data_baner_1',
                'data_banner_2',
                'data_sliders_principal_1',
                'data_candidatos_presidenciales',
                'data_candidatos_alcaldia_lima',
                'data_partidos_politicos',
                'data_encuesta_presidencial',
                'data_encuesta_alcaldia_provincial_lima',
                'data_encuestas_alcaldia_distritos_lima',
            )
        );
    }

    public function getWebBanner($id)
    {
        $banner = Banner::where('id', $id)
            ->where('activo', true)
            ->first();

        return $banner;
    }

    public function getWebSlidersPrincipal($id)
    {
        $sliders = Slider::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($sliders) {
            $sliders->imagenes = json_decode($sliders->imagenes, true);
        } else {
            $sliders = null;
        }

        return $sliders;
    }

    public function getWebCandidatosPresidenciales()
    {
        $eleccion_id = config('constantes.ELECCION_GENERAL_ID'); //generales
        $nivel_id = 1; //nacional
        $cargo_id = 1; // presidente

        $titulo = 'Candidatos a la presidencia';

        $candidatos = CandidatoCargo::with(['candidato', 'partido'])
            ->where('eleccion_id', $eleccion_id)
            ->where('nivel_id', $nivel_id)
            ->where('cargo_id', $cargo_id)
            ->whereDate('created_at', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_GENERAL'))
            ->get();

        return [
            'id' => $eleccion_id . $nivel_id . $cargo_id,
            'titulo' => $titulo,
            'candidatos' => $candidatos,
        ];
    }

    public function getWebCandidatosAlcaldiaLima()
    {
        $eleccion_id = config('constantes.ELECCION_REGIONAL_ID'); //municipales
        $nivel_id = 3; //provincial
        $cargo_id = 9; // alcaldía provincial

        $titulo = 'Candidatos a la alcaldía de Lima';

        $candidatos = CandidatoCargo::with(['candidato', 'partido'])
            ->where('eleccion_id', $eleccion_id)
            ->where('nivel_id', $nivel_id)
            ->where('cargo_id', $cargo_id)
            ->whereDate('created_at', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_REGIONAL'))
            ->get();

        return [
            'id' => $eleccion_id . $nivel_id . $cargo_id,
            'titulo' => $titulo,
            'candidatos' => $candidatos,
        ];
    }

    public function getWebpartidosPoliticos()
    {
        $consulta_id = 1;

        $titulo = 'Partidos políticos';

        $partidos = Partido::all();

        return [
            'id' => $consulta_id,
            'titulo' => $titulo,
            'partidos' => $partidos,
        ];
    }

    public function getWebEncuestaPresidencial()
    {
        $eleccion_id = config('constantes.ELECCION_GENERAL_ID'); //generales
        $nivel_id = 1; //nacional
        $cargo_id = 1; //presidente
        $pais_id = 1; //peru

        $cantidad_mostrar = 1;

        $encuesta = Encuesta::with(['eleccion:id,id,imagen_ruta'])
            ->where('eleccion_id', $eleccion_id)
            ->where('nivel_id', $nivel_id)
            ->where('cargo_id', $cargo_id)
            ->where('pais_id', $pais_id)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereDate('fecha_inicio', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_GENERAL'))
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->first();

        // Calcular la cantidad de días restantes
        $fecha_fin = Carbon::parse($encuesta->fecha_fin);
        $dias_restantes = now()->diffInDays($fecha_fin);

        // Redondear a entero
        $encuesta->dias = (int) $dias_restantes;

        return $encuesta;
    }

    public function getWebEncuestaAlcaldiaProvincialLima()
    {
        $eleccion_id = config('constantes.ELECCION_REGIONAL_ID'); //municipales
        $nivel_id = 3; //provincial
        $cargo_id = 9; //alcaldia provincial
        $provincia_id = 135; //lima

        $cantidad_mostrar = 1;

        $encuesta = Encuesta::with(['eleccion:id,id,imagen_ruta'])
            ->where('eleccion_id', $eleccion_id)
            ->where('nivel_id', $nivel_id)
            ->where('cargo_id', $cargo_id)
            ->where('provincia_id', $provincia_id)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereDate('fecha_inicio', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_REGIONAL'))
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->first();

        // Calcular la cantidad de días restantes
        $fecha_fin = Carbon::parse($encuesta->fecha_fin);
        $dias_restantes = now()->diffInDays($fecha_fin);

        // Redondear a entero
        $encuesta->dias = (int) $dias_restantes;

        return $encuesta;
    }

    public function getWebEncuestasAlcaldiaDistritosLima()
    {
        $eleccion_id = config('constantes.ELECCION_REGIONAL_ID'); //municipales
        $nivel_id = 4; // distrital
        $cargo_id = 11; //alcaldia distrital
        $provincia_id = 135; //lima

        $titulo = 'Encuestas alcaldía distritos de Lima';

        $subquery = DB::table('encuestas')
            ->select(DB::raw('MAX(id) as id'))
            ->where('eleccion_id', $eleccion_id)
            ->where('nivel_id', $nivel_id)
            ->where('cargo_id', $cargo_id)
            ->where('provincia_id', $provincia_id)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereDate('fecha_inicio', '>=', config('constantes.FECHA_CONVOCATORIA_ELECCION_REGIONAL'))
            ->whereDate('fecha_fin', '>=', now())
            ->groupBy('distrito_id');

        $encuestas = Encuesta::whereIn('id', $subquery)->orderBy('fecha_inicio', 'desc')->take(5)->get();

        return [
            'id' => $eleccion_id . $nivel_id . $cargo_id,
            'titulo' => $titulo,
            'encuestas' => $encuestas,
        ];
    }

    public function getWebEncuestasPresidenciales()
    {
        //eleccion_id = 1 -> generales
        //nivel_id = 1 -> nacional
        //cargo_id = 1 -> presidente
        //pais_id = 1 -> peru

        $encuestas = Encuesta::where('eleccion_id', 1)
            ->where('nivel_id', 1)
            ->where('cargo_id', 1)
            ->where('pais_id', 1)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereYear('fecha_inicio', now()->year)
            ->whereMonth('fecha_inicio', now()->month)
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->take(5)
            ->get();

        return $encuestas;
    }

    public function getWebEncuestasAlcaldiaProvincialLima()
    {
        //eleccion_id = 2 -> munipales
        //nivel_id = 3 -> provincial
        //cargo_id = 9 -> alcaldia provincial
        //provincia_id = 135 -> lima

        $encuestas = Encuesta::where('eleccion_id', 2)
            ->where('nivel_id', 3)
            ->where('cargo_id', 9)
            ->where('provincia_id', 135)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereYear('fecha_inicio', now()->year)
            ->whereMonth('fecha_inicio', now()->month)
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->take(5)
            ->get();

        return $encuestas;
    }

    public function getWebEncuestaAlcaldiaProvincialCallao()
    {
        //eleccion_id = 2 -> munipales
        //nivel_id = 3 -> provincial
        //cargo_id = 9 -> alcaldia provincial
        //provincia_id = 129 -> callao

        $encuestas = Encuesta::where('eleccion_id', 2)
            ->where('nivel_id', 3)
            ->where('cargo_id', 9)
            ->where('provincia_id', 129)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereYear('fecha_inicio', now()->year)
            ->whereMonth('fecha_inicio', now()->month)
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->take(5)
            ->get();

        return $encuestas;
    }

    public function getWebEncuestaAlcaldiaDistritoSJL()
    {
        //eleccion_id = 2 -> munipales
        //nivel_id = 3 -> provincial
        //cargo_id = 11 -> alcaldia distrital
        //distrito_id = 135 -> san juan de lurigancho

        $encuestas = Encuesta::where('eleccion_id', 2)
            ->where('nivel_id', 4)
            ->where('cargo_id', 11)
            ->where('distrito_id', 1369)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereYear('fecha_inicio', now()->year)
            ->whereMonth('fecha_inicio', now()->month)
            ->whereDate('fecha_fin', '>=', now())
            ->orderBy('fecha_inicio', 'desc')
            ->take(5)
            ->get();

        return $encuestas;
    }

    public function getRegionesGobiernoRegional()
    {
        $regiones = Region::join('encuestas', 'regions.id', '=', 'encuestas.region_id')
            ->where('encuestas.eleccion_id', 2)
            ->where('encuestas.nivel_id', 2)
            ->where('encuestas.cargo_id', 6)
        //->where('encuestas.estado', 'iniciada')
        //->where('encuestas.activo', true)
        //->whereYear('encuestas.fecha_inicio', now()->year)
        //->whereMonth('encuestas.fecha_inicio', now()->month)
        //->whereDate('encuestas.fecha_fin', '>=', now())
            ->select('regions.id', 'regions.nombre')
            ->distinct()
            ->orderBy('regions.nombre')
            ->get();

        return $regiones;
    }

    public function getProvinciasAlcaldiaPrinvicial()
    {
        $regiones = Provincia::join('encuestas', 'provincias.id', '=', 'encuestas.provincia_id')
            ->where('encuestas.eleccion_id', 2)
            ->where('encuestas.nivel_id', 3)
            ->where('encuestas.cargo_id', 9)
        //->where('encuestas.estado', 'iniciada')
        //->where('encuestas.activo', true)
        //->whereYear('encuestas.fecha_inicio', now()->year)
        //->whereMonth('encuestas.fecha_inicio', now()->month)
        //->whereDate('encuestas.fecha_fin', '>=', now())
            ->select('provincias.id', 'provincias.nombre')
            ->distinct()
            ->orderBy('provincias.nombre')
            ->get();

        return $regiones;
    }

    public function getDistritosAlcaldiaLima()
    {
        $distritos = Distrito::join('encuestas', 'distritos.id', '=', 'encuestas.distrito_id')
            ->where('encuestas.eleccion_id', 2)
            ->where('encuestas.nivel_id', 4)
            ->where('encuestas.cargo_id', 11)
            ->where('encuestas.provincia_id', 135)
        //->where('encuestas.estado', 'iniciada')
        //->where('encuestas.activo', true)
        //->whereYear('encuestas.fecha_inicio', now()->year)
        //->whereMonth('encuestas.fecha_inicio', now()->month)
        //->whereDate('encuestas.fecha_fin', '>=', now())
            ->select('distritos.id', 'distritos.nombre')
            ->distinct()
            ->orderBy('distritos.nombre')
            ->get();

        return $distritos;
    }
}
