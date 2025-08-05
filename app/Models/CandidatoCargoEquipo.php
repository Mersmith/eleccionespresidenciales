<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatoCargoEquipo extends Model
{
    /** @use HasFactory<\Database\Factories\CandidatoCargoEquipoFactory> */
    use HasFactory;

    protected $table = 'candidato_cargo_equipo';

    protected $fillable = [
        'lider_candidato_cargo_id',
        'integrante_candidato_cargo_id',
        'rol',
        'orden',
    ];

    // 🔹 Relación al líder
    public function lider()
    {
        return $this->belongsTo(
            CandidatoCargo::class,
            'lider_candidato_cargo_id'
        );
    }

    // 🔹 Relación al integrante
    public function integrante()
    {
        return $this->belongsTo(
            CandidatoCargo::class,
            'integrante_candidato_cargo_id'
        );
    }

}
