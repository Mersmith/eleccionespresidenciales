<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    /** @use HasFactory<\Database\Factories\CandidatoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'foto',
        'partido_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'cargo_id',
        'activo',
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'candidato_cargo')
            ->withPivot('eleccion_id', 'partido_id', 'region_id', 'provincia_id', 'distrito_id')
            ->withTimestamps();
    }

    public function encuestas()
    {
        return $this->belongsToMany(Encuesta::class, 'candidato_encuesta');
    }

    public function votos()
    {
        return $this->hasMany(Voto::class);
    }

    public function elecciones()
    {
        return $this->belongsToMany(Eleccion::class, 'candidato_cargo')
            ->withPivot('cargo_id', 'partido_id', 'region_id', 'provincia_id', 'distrito_id')
            ->withTimestamps();
    }
}
