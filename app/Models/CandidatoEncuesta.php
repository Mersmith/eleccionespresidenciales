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

    public function candidatoCargo() //ok
    {
        return $this->belongsTo(CandidatoCargo::class, 'candidato_cargo_id');
    }

    public function encuesta() //ok
    {
        return $this->belongsTo(Encuesta::class);
    }
}
