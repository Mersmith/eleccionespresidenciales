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
    ];

    public function encuestas() {
        return $this->belongsToMany(Encuesta::class, 'candidato_encuesta');
    }

    public function votos() {
        return $this->hasMany(Voto::class);
    }
}
