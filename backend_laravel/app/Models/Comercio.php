<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;

    protected $table = 'comercios';
    protected $primaryKey = 'id_comercio';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'nombre_comercial',
        'direccion',
        'horario',
        'activo',
    ];
}
