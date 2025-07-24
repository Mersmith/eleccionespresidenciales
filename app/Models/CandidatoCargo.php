<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatoCargo extends Model
{
    protected $table = 'candidato_cargo';

    protected $fillable = [
        'nivel_id',
        'candidato_id',
        'cargo_id',
        'eleccion_id',
        'partido_id',
        'pais_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'principal',
        'electo',
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
}
