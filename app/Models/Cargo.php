<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /** @use HasFactory<\Database\Factories\CargoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nivel_id',
        'tipo_eleccion_id',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function tipoEleccion()
    {
        return $this->belongsTo(TipoEleccion::class, 'tipo_eleccion_id');
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'candidato_cargo')
            ->withPivot(['eleccion_id', 'partido_id', 'pais_id', 'region_id', 'provincia_id', 'distrito_id', 'principal', 'electo'])
            ->withTimestamps();
    }
}
