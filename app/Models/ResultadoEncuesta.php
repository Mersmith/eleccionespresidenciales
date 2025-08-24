<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoEncuesta extends Model
{
    /** @use HasFactory<\Database\Factories\ResultadoEncuestaFactory> */
    use HasFactory;

    protected $fillable = [
        'encuesta_id',
        'candidato_cargo_id',
        'total_votos',
    ];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }

    public function candidatoCargo()
    {
        return $this->belongsTo(CandidatoCargo::class);
    }
}
