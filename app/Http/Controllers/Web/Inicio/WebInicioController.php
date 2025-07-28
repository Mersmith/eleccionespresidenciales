<?php

namespace App\Http\Controllers\Web\Inicio;

use App\Http\Controllers\Controller;
use App\Models\CandidatoCargo;
use App\Models\Distrito;
use App\Models\Encuesta;
use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class WebInicioController extends Controller
{
    public function __invoke()
    {
        $data_candidatos_presidenciales = $this->getCandidatosPresidenciales();
        $data_candidatos_alcaldia_lima = $this->getCandidatosAlcaldiaLima();
        $data_encuesta_presidencial = $this->getWebEncuestaPresidencial();
        $data_encuesta_alcaldia_provincial_lima = $this->getWebEncuestaAlcaldiaProvincialLima();
        $data_encuesta_alcaldia_provincial_callao = $this->getWebEncuestaAlcaldiaProvincialCallao();
        $data_encuesta_alcaldia_distrital_SJL = $this->getWebEncuestaAlcaldiaDistritoSJL();
        $data_encuesta_alcaldia_distrital_lima_distritos = $this->getWebEncuestaAlcaldiaDistritosLima();
        $data_regiones_gobierno_regional = $this->getRegionesGobiernoRegional();
        $data_provincias_alcaldia_provincial = $this->getProvinciasAlcaldiaPrinvicial();
        $data_distritos_alcaldia_lima = $this->getDistritosAlcaldiaLima();

        //dd($data_candidatos_presidenciales);

        return view(
            'web.inicio.index',
            compact(
                'data_candidatos_presidenciales',
                'data_candidatos_alcaldia_lima',
            )
        );
    }

    public function getCandidatosPresidenciales()
    {
        //eleccion_id = 1 -> generales
        //nivel_id = 1 -> nacional
        //cargo_id = 1 -> presidente

        $candidatos = CandidatoCargo::with(['candidato', 'partido'])
            ->where('eleccion_id', 1)
            ->where('nivel_id', 1)
            ->where('cargo_id', 1)
            ->get();

        return $candidatos;
    }

    public function getCandidatosAlcaldiaLima()
    {
        //eleccion_id = 2 -> municipales
        //nivel_id = 3 -> provincial
        //cargo_id = 9 -> alcaldía provincial

        $candidatos = CandidatoCargo::with(['candidato', 'partido'])
            ->where('eleccion_id', 2)
            ->where('nivel_id', 3)
            ->where('cargo_id', 9)
            ->get();

        return $candidatos;
    }

    public function getWebEncuestaPresidencial()
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

    public function getWebEncuestaAlcaldiaProvincialLima()
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

    public function getWebEncuestaAlcaldiaDistritosLima()
    {
        //eleccion_id = 2 -> munipales
        //nivel_id = 4 -> distrital
        //cargo_id = 11 -> alcaldia distrital
        //provincia_id = 135 -> lima

        $subquery = DB::table('encuestas')
            ->select(DB::raw('MAX(id) as id'))
            ->where('eleccion_id', 2)
            ->where('nivel_id', 4)
            ->where('cargo_id', 11)
            ->where('provincia_id', 135)
            ->where('estado', 'iniciada')
            ->where('activo', true)
            ->whereYear('fecha_inicio', now()->year)
            ->whereMonth('fecha_inicio', now()->month)
            ->whereDate('fecha_fin', '>=', now())
            ->groupBy('distrito_id');

        $encuestas = Encuesta::whereIn('id', $subquery)->orderBy('fecha_inicio', 'desc')->take(5)->get();

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
