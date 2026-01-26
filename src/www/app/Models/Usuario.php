<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'contrasena_hash',
        'rol'
    ];

    protected $hidden = [
        'contrasena_hash'
    ];

    public function comercios()
    {
        return $this->hasMany(Comercio::class, 'id_usuario', 'id_usuario');
    }
}
