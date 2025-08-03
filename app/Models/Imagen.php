<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /** @use HasFactory<\Database\Factories\ImagenFactory> */
    use HasFactory;

    protected $fillable = ['path', 'url', 'titulo', 'descripcion', 'extension'];

}
