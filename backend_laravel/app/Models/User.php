<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de Usuario (User)
 *
 * Representa un usuario del sistema SocialFood que puede tener
 * rol de comercio, voluntario u ONG. Extiende Authenticatable
 * para soporte de autenticación de Laravel.
 *
 * @package App\Models
 * @author SocialFood Team
 * @version 1.0
 *
 * @property int $id_usuario ID único del usuario
 * @property string $nombre Nombre completo del usuario
 * @property string $email Correo electrónico único
 * @property string|null $telefono Número telefónico
 * @property string $contrasena_hash Contraseña hasheada
 * @property string $rol Rol del usuario: comercio, voluntario, ong
 * @property string|null $remember_token Token para "recordarme"
 */
class User extends Authenticatable
{
    use Notifiable;

    /** @var string Nombre de la tabla en la base de datos */
    protected $table = 'usuarios';

    /** @var string Clave primaria de la tabla */
    protected $primaryKey = 'id_usuario';

    /** @var bool Indica si se usan timestamps automáticos */
    public $timestamps = false;

    /**
     * Atributos asignables en masa
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'contrasena_hash',
        'rol'
    ];

    /**
     * Atributos ocultos en serialización JSON
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena_hash',
        'remember_token',
    ];

    /**
     * Obtiene la contraseña para autenticación
     *
     * Override del método de Authenticatable para usar
     * el campo contrasena_hash en lugar de password.
     *
     * @return string Contraseña hasheada del usuario
     */
    public function getAuthPassword()
    {
        return $this->contrasena_hash;
    }
}
