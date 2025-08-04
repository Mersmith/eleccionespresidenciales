<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\Web\Inicio\WebInicioController;
use App\Http\Controllers\Web\Candidato\WebCandidatoController;
use App\Http\Controllers\Web\Partido\WebPartidoController;
use App\Http\Controllers\Web\Alianza\WebAlianzaController;
use App\Http\Controllers\Web\Encuesta\WebEncuestaController;
use App\Livewire\Web\Encuesta\EncuestaResultadoLivewire;
use App\Livewire\Web\Encuestas\EncuestasLivewire;

Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

Route::get('/', WebInicioController::class)->name('inicio');//ok

Route::get('/candidato/{id}/{slug?}', WebCandidatoController::class)->name('candidato');//ok

Route::get('/partido/{id}/{slug?}', WebPartidoController::class)->name('partido');//ok

Route::get('/alianza/{id}/{slug?}', WebAlianzaController::class)->name('alianza');//ok

Route::get('/encuesta/{id}/votar/{slug?}', WebEncuestaController::class)->name('encuesta');//ok
Route::get('/encuesta/{id}/resultado/{slug?}', EncuestaResultadoLivewire::class)->name('encuesta.resultado');//ok
Route::get('/encuestas', EncuestasLivewire::class)->name('encuestas');//ok

/*Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});*/



require __DIR__.'/auth.php';
