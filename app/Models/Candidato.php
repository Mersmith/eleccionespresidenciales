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
        'descripcion',
        'foto',
        'partido_id',
    ];

    public function encuestas() {
        return $this->belongsToMany(Encuesta::class, 'candidato_encuesta');
    }

    public function votos() {
        return $this->hasMany(Voto::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }
}
