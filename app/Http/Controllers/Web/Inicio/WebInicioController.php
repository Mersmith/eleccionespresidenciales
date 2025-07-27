<?php

namespace App\Http\Controllers\Web\Inicio;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Encuesta;
use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class WebInicioController extends Controller
{
    public function __invoke()
    {
        $data_menu_principal = $this->getMenuPrincipal();
        $data_encuesta_presidencial = $this->getWebEncuestaPresidencial();
        $data_encuesta_alcaldia_provincial_lima = $this->getWebEncuestaAlcaldiaProvincialLima();
        $data_encuesta_alcaldia_provincial_callao = $this->getWebEncuestaAlcaldiaProvincialCallao();
        $data_encuesta_alcaldia_distrital_SJL = $this->getWebEncuestaAlcaldiaDistritoSJL();
        $data_encuesta_alcaldia_distrital_lima_distritos = $this->getWebEncuestaAlcaldiaDistritosLima();
        $data_regiones_gobierno_regional = $this->getRegionesGobiernoRegional();
        $data_provincias_alcaldia_provincial = $this->getProvinciasAlcaldiaPrinvicial();
        $data_distritos_alcaldia_lima = $this->getDistritosAlcaldiaLima();

        //dd($data_provincias_alcaldia_provincial);

        return view(
            'web.inicio.index',
            compact(
                'data_encuesta_presidencial',
            )
        );
    }

    public function getMenuPrincipal()
    {
        /*
        PRESIDENCIAL->PAIS
        PARLAMENTO ANDINO->PAIS
        SEDADORES->PAIS-REGION
        DIPUTADOS->PAIS-REGION
        GOBERNADOR REGIONAL->PAIS-REGION
        ALCALDE PROVINCIAL->PAIS-REGION-PROVINCIA
        ALCALDE DISTRITAL->PAIS-REGION-PROVINCIA-DISTRITO
         */
        $menu = [
            [
                'eleccion_id' => 1,
                'nivel_id' => 1,
                'cargo_id' => 1,
                'cargo_nombre' => 'PRESIDENCIAL',
                'pais' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [],
                ],
            ],
            [
                'eleccion_id' => 1,
                'nivel_id' => 1,
                'cargo_id' => 5,
                'cargo_nombre' => 'PARLAMENTO ANDINO',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [],

                        ],
                        [
                            'id' => 2,
                            'nombre' => 'CALLAO',
                            'provincias' => [],
                        ],
                    ],
                ],
            ],
            [
                'eleccion_id' => 1,
                'nivel_id' => 1,
                'cargo_id' => 4,
                'cargo_nombre' => 'DIPUTADOS',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [],

                        ],
                        [
                            'region_id' => 2,
                            'region_nombre' => 'CALLAO',
                            'provincias' => [],
                        ],
                    ],
                ],
            ],
            [
                'eleccion_id' => 1,
                'nivel_id' => 1,
                'cargo_id' => 3,
                'cargo_nombre' => 'SEDADORES',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [],

                        ],
                        [
                            'region_id' => 2,
                            'region_nombre' => 'CALLAO',
                            'provincias' => [],
                        ],
                    ],
                ],
            ],
            [
                'eleccion_id' => 2,
                'nivel_id' => 2,
                'cargo_id' => 6,
                'cargo_nombre' => 'GOBERNADOR REGIONAL',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [],

                        ],
                        [
                            'id' => 2,
                            'nombre' => 'ANCASH',
                            'provincias' => [],
                        ],
                    ],
                ],
            ],
            [
                'eleccion_id' => 2,
                'nivel_id' => 3,
                'cargo_id' => 9,
                'cargo_nombre' => 'ALCALDE PROVINCIAL',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [
                                [
                                    'provincia_id' => 1,
                                    'provincia_nombre' => 'LIMA',
                                    'distritos' => [],

                                ],
                                [
                                    'provincia_id' => 2,
                                    'provincia_nombre' => 'YAUYOS',
                                    'distritos' => [],
                                ],
                            ],

                        ],
                        [
                            'region_id' => 2,
                            'region_nombre' => 'ANCASH',
                            'provincias' => [
                                [
                                    'provincia_id' => 1,
                                    'provincia_nombre' => 'HUARAZ',
                                    'distritos' => [],

                                ],
                                [
                                    'provincia_id' => 2,
                                    'provincia_nombre' => 'RECUAY',
                                    'distritos' => [],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'eleccion_id' => 2,
                'nivel_id' => 4,
                'cargo_id' => 11,
                'cargo_nombre' => 'ALCALDE DISTRITAL',
                'paises' => [
                    'pais_id' => 1,
                    'pais_nombre' => 'PERU',
                    'regiones' => [
                        [
                            'region_id' => 1,
                            'region_nombre' => 'LIMA',
                            'provincias' => [
                                [
                                    'provincia_id' => 1,
                                    'provincia_nombre' => 'LIMA',
                                    'distritos' => [
                                        [
                                            'distrito_id' => 1,
                                            'distrito_nombre' => 'SAN JUAN DE LURIGANCHO',

                                        ],
                                        [
                                            'distrito_id' => 2,
                                            'distrito_nombre' => 'LA VICTORIA',
                                        ],
                                    ],

                                ],
                                [
                                    'provincia_id' => 2,
                                    'provincia_nombre' => 'YAUYOS',
                                    'distritos' => [
                                        [
                                            'distrito_id' => 1,
                                            'distrito_nombre' => 'LARAOS',

                                        ],
                                        [
                                            'distrito_id' => 2,
                                            'distrito_nombre' => 'LINCHA',
                                        ],
                                    ],
                                ],
                            ],

                        ],
                        [
                            'region_id' => 2,
                            'region_nombre' => 'ANCASH',
                            'provincias' => [
                                [
                                    'provincia_id' => 1,
                                    'provincia_nombre' => 'HUARAZ',
                                    'distritos' => [
                                        [
                                            'distrito_id' => 1,
                                            'distrito_nombre' => 'PIRA',

                                        ],
                                        [
                                            'distrito_id' => 2,
                                            'distrito_nombre' => 'TARICA',
                                        ],
                                    ],

                                ],
                                [
                                    'provincia_id' => 2,
                                    'provincia_nombre' => 'RECUAY',
                                    'distritos' => [
                                        [
                                            'distrito_id' => 1,
                                            'distrito_nombre' => 'CATAC',

                                        ],
                                        [
                                            'distrito_id' => 2,
                                            'distrito_nombre' => 'MARCA',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

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
