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
        'nivel_id',
        'tipo_eleccion_id',
    ];

    public function nivel() //ok
    {
        return $this->belongsTo(Nivel::class);
    }

    public function tipoEleccion() //ok
    {
        return $this->belongsTo(TipoEleccion::class, 'tipo_eleccion_id');
    }

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }

}
