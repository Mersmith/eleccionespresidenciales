<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatoCargo extends Model
{
    protected $table = 'candidato_cargo';

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
