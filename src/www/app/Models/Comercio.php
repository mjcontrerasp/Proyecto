<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Comercio
 *
 * Representa un establecimiento comercial que dona alimentos
 * en la plataforma SocialFood. Está asociado a un usuario
 * con rol 'comercio'.
 *
 * @package App\Models
 * @author SocialFood Team
 * @version 1.0
 *
 * @property int $id_comercio ID único del comercio
 * @property int $id_usuario ID del usuario propietario
 * @property string $nombre_comercial Nombre del establecimiento
 * @property string|null $direccion Dirección física del comercio
 * @property string|null $horario Horario de atención
 * @property bool $activo Estado del comercio (activo/inactivo)
 */
class Comercio extends Model
{
    use HasFactory;

    /** @var string Nombre de la tabla en la base de datos */
    protected $table = 'comercios';

    /** @var string Clave primaria de la tabla */
    protected $primaryKey = 'id_comercio';

    /** @var bool Indica si se usan timestamps automáticos */
    public $timestamps = false;

    /**
     * Atributos asignables en masa
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'nombre_comercial',
        'direccion',
        'horario',
        'activo',
    ];
}
