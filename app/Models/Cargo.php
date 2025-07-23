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
        'nivel',
        'eleccion_id',
    ];

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'candidato_cargo')
            ->withPivot('eleccion_id', 'partido_id', 'region_id', 'provincia_id', 'distrito_id')
            ->withTimestamps();
    }
}
