<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckCandidato;
use App\Http\Middleware\CheckVotante;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'check.admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
            Route::middleware(['web', 'check.votante'])
                ->prefix('votante')
                ->name('votante.')
                ->group(base_path('routes/votante.php'));
            Route::middleware(['web', 'check.candidato'])
                ->prefix('candidato')
                ->name('candidato.')
                ->group(base_path('routes/candidato.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check.admin' => CheckAdmin::class,
            'check.votante' => CheckVotante::class,
            'check.candidato' => CheckCandidato::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
