<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    /** @use HasFactory<\Database\Factories\PartidoFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'sigla', 'logo'];

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
