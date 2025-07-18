<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Livewire\CategoriaCrud;
use App\Livewire\EncuestaCrear;
use App\Livewire\EncuestaEditar;
use App\Livewire\EncuestaLista;
use App\Livewire\EncuestaCandidatoLista;
use App\Livewire\EncuestaVotacion;
use App\Livewire\EncuestaResultado;
use App\Livewire\CandidatoLista;
use App\Livewire\CandidatoCrear;
use App\Livewire\CandidatoEditar;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/categoria', CategoriaCrud::class)->name('categoria');

Route::get('/encuesta', EncuestaLista::class)->name('encuesta.lista');
Route::get('/encuesta/crear', EncuestaCrear::class)->name('encuesta.crear');
Route::get('/encuesta/editar/{id}', EncuestaEditar::class)->name('encuesta.editar');
Route::get('/encuesta/{id}/candidato', EncuestaCandidatoLista::class)->name('encuesta.candidato.lista');
Route::get('/encuesta/{id}/votacion', EncuestaVotacion::class)->name('encuesta.votacion');
Route::get('/encuesta/{id}/resultado', EncuestaResultado::class)->name('encuesta.resultado');

Route::get('/candidato', CandidatoLista::class)->name('candidato.lista');
Route::get('/candidato/crear', CandidatoCrear::class)->name('candidato.crear');
Route::get('/candidato/editar/{id}', CandidatoEditar::class)->name('candidato.editar');

require __DIR__.'/auth.php';
