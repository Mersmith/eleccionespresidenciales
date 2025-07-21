<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Eleccion\EleccionTodasLivewire;
use App\Livewire\Admin\Eleccion\EleccionCrearLivewire;
use App\Livewire\Admin\Eleccion\EleccionEditarLivewire;
use App\Livewire\Admin\Cargo\CargoTodasLivewire;
use App\Livewire\Admin\Cargo\CargoCrearLivewire;
use App\Livewire\Admin\Cargo\CargoEditarLivewire;
use App\Livewire\Admin\Partido\PartidoTodasLivewire;
use App\Livewire\Admin\Partido\PartidoCrearLivewire;
use App\Livewire\Admin\Partido\PartidoEditarLivewire;
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

Route::get('/eleccion', EleccionTodasLivewire::class)->name('eleccion.vista.todas');
Route::get('/eleccion/crear', EleccionCrearLivewire::class)->name('eleccion.vista.crear');
Route::get('/eleccion/editar/{id}', EleccionEditarLivewire::class)->name('eleccion.vista.editar');

Route::get('/cargo', CargoTodasLivewire::class)->name('cargo.vista.todas');
Route::get('/cargo/crear', CargoCrearLivewire::class)->name('cargo.vista.crear');
Route::get('/cargo/editar/{id}', CargoEditarLivewire::class)->name('cargo.vista.editar');

Route::get('/partido', PartidoTodasLivewire::class)->name('partido.vista.todas');
Route::get('/partido/crear', PartidoCrearLivewire::class)->name('partido.vista.crear');
Route::get('/partido/editar/{id}', PartidoEditarLivewire::class)->name('partido.vista.editar');

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