<?php

namespace App\Livewire\Admin\Reporte;

use App\Models\Auspiciador;
use App\Models\Candidato;
use App\Models\Membresia;
use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class ReporteInicioLivewire extends Component
{
    public $pagosPorMes = [];
    public $recaudacionPorMes = [];
    public $recaudacionPorAnio = [];
    public $pagosPorAnio = [];
    public $topCandidatos;
    public $topAuspiciadores;
    public $pagosNoRealizados = 0;
    public $pagosFallidos;
    public $recaudacionPorTipo = [];
    public $miembrosPagoPorTipo = [];
    public $ultimosPagos;
    public $resumen = [];
    public $rankingPlanes;

    public function mount()
    {
        $this->loadEstadisticas();
    }

    public function loadEstadisticas()
    {
        $this->pagosPorMes = Membresia::selectRaw("DATE_FORMAT(mes, '%Y-%m') as mes_formateado, COUNT(*) as cantidad")
            ->where('pagado', true)
            ->groupBy('mes_formateado')
            ->orderBy('mes_formateado')
            ->pluck('cantidad', 'mes_formateado')
            ->toArray();

        $this->recaudacionPorMes = Membresia::selectRaw("DATE_FORMAT(mes, '%Y-%m') as mes_formateado, SUM(precio_pagado) as total")
            ->where('pagado', true)
            ->groupBy('mes_formateado')
            ->orderBy('mes_formateado')
            ->pluck('total', 'mes_formateado')
            ->toArray();

        $this->recaudacionPorAnio = Membresia::selectRaw("YEAR(mes) as anio, SUM(precio_pagado) as total")
            ->where('pagado', true)
            ->groupBy('anio')
            ->orderBy('anio')
            ->pluck('total', 'anio')
            ->toArray();

        $this->pagosPorAnio = Membresia::selectRaw("YEAR(mes) as anio, COUNT(*) as cantidad")
            ->where('pagado', true)
            ->groupBy('anio')
            ->orderBy('anio')
            ->pluck('cantidad', 'anio')
            ->toArray();

        $this->topCandidatos = Membresia::selectRaw("candidato_id, COUNT(*) as cantidad, SUM(precio_pagado) as total")
            ->where('pagado', true)
            ->whereNotNull('candidato_id')
            ->groupBy('candidato_id')
            ->orderByDesc('total')
            ->with('candidato') // si defines relación
            ->limit(10)
            ->get();

        $this->topAuspiciadores = Membresia::selectRaw("auspiciador_id, COUNT(*) as cantidad, SUM(precio_pagado) as total")
            ->where('pagado', true)
            ->whereNotNull('auspiciador_id')
            ->groupBy('auspiciador_id')
            ->orderByDesc('total')
            ->with('auspiciador') // si defines relación
            ->limit(10)
            ->get();

        $this->pagosNoRealizados = Membresia::where('pagado', false)->count();

        $this->pagosFallidos = Membresia::where('pagado', false)
            ->latest()
            ->limit(10)
            ->get();

        $this->recaudacionPorTipo = [
            'candidatos' => Membresia::whereNotNull('candidato_id')->where('pagado', true)->sum('precio_pagado'),
            'auspiciadores' => Membresia::whereNotNull('auspiciador_id')->where('pagado', true)->sum('precio_pagado'),
        ];

        $this->miembrosPagoPorTipo = [
            'candidatos' => Candidato::whereHas('plan', function ($q) {
                $q->where('requiere_pago', true);
            })->count(),

            'auspiciadores' => Auspiciador::whereHas('plan', function ($q) {
                $q->where('requiere_pago', true);
            })->count(),
        ];

        $this->ultimosPagos = Membresia::where('pagado', true)
            ->latest()
            ->limit(10)
            ->get();

        $this->resumen = [
            'total_membresias' => Membresia::count(),
            'pagadas' => Membresia::where('pagado', true)->count(),
            'no_pagadas' => Membresia::where('pagado', false)->count(),
            'total_recaudado' => Membresia::where('pagado', true)->sum('precio_pagado'),
        ];

        $this->rankingPlanes = Membresia::selectRaw('plan_id, COUNT(*) as total')
            ->groupBy('plan_id')
            ->with('plan')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->plan?->nombre ?? 'Sin plan',
                    'total' => $item->total,
                ];
            });
    }

    public function render()
    {
        return view('livewire.admin.reporte.reporte-inicio-livewire', [
            'labels' => array_keys($this->pagosPorMes),
            'datosPagos' => array_values($this->pagosPorMes),
            'datosRecaudacion' => array_values($this->recaudacionPorMes),
            'recaudacionPorAnio' => $this->recaudacionPorAnio,
            'pagosPorAnio' => $this->pagosPorAnio,
            'topCandidatos' => $this->topCandidatos,
            'topAuspiciadores' => $this->topAuspiciadores,
            'pagosNoRealizados' => $this->pagosNoRealizados,
            'pagosFallidos' => $this->pagosFallidos,
            'recaudacionPorTipo' => $this->recaudacionPorTipo,
            'miembrosPagoPorTipo' => $this->miembrosPagoPorTipo,
            'ultimosPagos' => $this->ultimosPagos,
            'resumen' => $this->resumen,
            'planes' => $this->rankingPlanes,
        ]);
    }
}
