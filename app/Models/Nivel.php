<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /** @use HasFactory<\Database\Factories\NivelFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais',
        'region',
        'provincia',
        'distrito',
    ];

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }
}
