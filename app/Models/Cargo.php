<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /** @use HasFactory<\Database\Factories\CargoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nivel',
        'eleccion_id',
    ];
    
    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
