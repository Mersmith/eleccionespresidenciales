<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    /** @use HasFactory<\Database\Factories\EleccionFactory> */
    use HasFactory;

    const GENERAL = 'GENERALES';
    const MUNICIPAL = 'REGIONALES Y MUNICIPALES';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function tipoEleccion()
    {
        return $this->belongsTo(TipoEleccion::class, 'tipo_eleccion_id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->hasManyThrough(Candidato::class, Cargo::class);
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
