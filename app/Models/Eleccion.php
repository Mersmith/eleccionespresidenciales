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

    protected $fillable = [
        'nombre', 'slug', 'descripcion', 'tipo_eleccion_id',
        'imagen_ruta', 'fecha_votacion', 'activo',
    ];

    public function tipoEleccion() //ok
    {
        return $this->belongsTo(TipoEleccion::class, 'tipo_eleccion_id');
    }

    public function cargos() //ok
    {
        return $this->hasMany(Cargo::class);
    }

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatoCargos() //ok
    {
        return $this->hasMany(CandidatoCargo::class);
    }

    public function partidos()
    {
        return $this->belongsToMany(Partido::class, 'partido_eleccion')
            ->withPivot(['numero_en_papeleta', 'activo'])
            ->withTimestamps();
    }

    public function alianzas()
    {
        return $this->belongsToMany(Alianza::class, 'alianza_eleccion')
            ->withPivot(['numero_en_papeleta', 'activo'])
            ->withTimestamps();
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
