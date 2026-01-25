<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
        'contrasena_hash',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena_hash;
    }
}
