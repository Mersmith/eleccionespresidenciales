<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    /** @use HasFactory<\Database\Factories\PaisFactory> */
    use HasFactory;

    protected $table = 'pais'; // Especificamos el nombre porque no es plural

    public function regiones() //ok
    {
        return $this->hasMany(Region::class);
    }

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }
}
