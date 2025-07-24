<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatoEncuesta extends Model
{
    protected $table = 'candidato_encuesta';

    protected $fillable = [
        'candidato_cargo_id',
        'encuesta_id',
    ];

    public function candidato()
    {
        return $this->hasOneThrough(
            Candidato::class,
            CandidatoCargo::class,
            'id', // CandidatoCargo id
            'id', // Candidato id
            'candidato_cargo_id', // Foreign key on this model
            'candidato_id' // Foreign key on CandidatoCargo
        );
    }

    public function candidatoCargo()
    {
        return $this->belongsTo(CandidatoCargo::class);
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }
}
