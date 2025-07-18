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
        'encuesta_id',
    ];

    public function encuesta() {
        return $this->belongsTo(Encuesta::class);
    }
    
    public function votos() {
        return $this->hasMany(Voto::class);
    }
}
