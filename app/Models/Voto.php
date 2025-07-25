<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    /** @use HasFactory<\Database\Factories\VotoFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'encuesta_id',
        'candidato_cargo_id',
        'fecha_voto',
    ];

    public function user() //ok
    {
        return $this->belongsTo(User::class);
    }

    public function encuesta() //ok
    {
        return $this->belongsTo(Encuesta::class);
    }

    public function candidatoCargo() //ok
    {
        return $this->belongsTo(CandidatoCargo::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
}
