<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatoEncuesta extends Model
{
    protected $table = 'candidato_encuesta';

    protected $fillable = [
        'candidato_id',
        'encuesta_id',
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }
}
