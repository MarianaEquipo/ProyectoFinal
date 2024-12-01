<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $table = 'migracion';
    protected $fillable = [
        'titulo','autor','genero','sinopsis','duracion','portada','gusto','fecha','video','tipo'
    ];
}
