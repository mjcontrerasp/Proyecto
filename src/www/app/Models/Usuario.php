<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo base de Usuario (Eloquent)
 *
 * Representa registros de la tabla `usuarios` usados en relaciones y
 * consultas directas donde no es necesario el soporte de autenticación.
 * Para autenticación se utiliza el modelo `User` que extiende Authenticatable.
 *
 * @package App\Models
 * @author SocialFood Team
 * @version 1.0
 *
 * @property int $id_usuario ID único del usuario
 * @property string $nombre Nombre completo
 * @property string $email Correo electrónico
 * @property string|null $telefono Teléfono de contacto
 * @property string $contrasena_hash Contraseña hasheada
 * @property string $rol Rol del usuario (comercio|voluntario|ong)
 */
class Usuario extends Model
{
    use HasFactory;

    /** @var string Tabla asociada */
    protected $table = 'usuarios';

    /** @var string Clave primaria */
    protected $primaryKey = 'id_usuario';

    /** @var bool Sin timestamps automáticos */
    public $timestamps = false;

    /** @var array<int,string> Atributos asignables en masa */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'contrasena_hash',
        'rol'
    ];

    /** @var array<int,string> Atributos ocultos */
    protected $hidden = [
        'contrasena_hash'
    ];

    /**
     * Relación: un usuario (comercio) tiene muchos comercios
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comercios()
    {
        return $this->hasMany(Comercio::class, 'id_usuario', 'id_usuario');
    }
}
