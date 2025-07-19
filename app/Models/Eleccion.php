<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    /** @use HasFactory<\Database\Factories\EleccionFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'fecha'];

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
