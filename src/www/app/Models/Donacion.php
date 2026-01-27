<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Donación
 *
 * Representa una donación de alimentos en el sistema SocialFood.
 * Gestiona el ciclo completo desde la publicación por el comercio,
 * asignación a voluntario, transporte y entrega a ONG.
 *
 * Estados posibles:
 * - 'No asignada': Publicada, esperando voluntario
 * - 'Asignada': Voluntario asignado
 * - 'Recogida': Recogida del comercio
 * - 'En camino': En transporte a ONG
 * - 'Entregada': Entregada a ONG
 * - 'Recogida confirmada': Confirmada por comercio
 *
 * @package App\Models
 * @author SocialFood Team
 * @version 1.0
 *
 * @property int $id ID único de la donación
 * @property int $id_usuario ID del comercio donante
 * @property string $tipo_comida Tipo de alimento donado
 * @property string $cantidad Cantidad disponible
 * @property string $fecha_hora Fecha límite de recogida
 * @property string $punto_recogida Dirección de recogida
 * @property string|null $observaciones Notas adicionales
 * @property string|null $foto Ruta de la foto del alimento
 * @property string $estado Estado actual de la donación
 * @property int|null $id_voluntario_asignado ID del voluntario
 * @property int|null $id_ong_destino ID de la ONG destino
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación
 * @property \Illuminate\Support\Carbon|null $updated_at Fecha de actualización
 *
 * @property-read User $usuario Usuario comercio que creó la donación
 * @property-read User|null $voluntario Voluntario asignado
 * @property-read Comercio $comercio Datos del comercio
 * @property-read User|null $ong ONG destino
 */
class Donacion extends Model
{
    use HasFactory;

    /** @var string Nombre de la tabla en la base de datos */
    protected $table = 'donaciones';

    /** @var string Clave primaria de la tabla */
    protected $primaryKey = 'id';

    /** @var bool Indica si se usan timestamps automáticos */
    public $timestamps = true;

    /**
     * Atributos asignables en masa
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'id_usuario',
    'tipo_comida',
    'cantidad',
    'fecha_hora',
    'punto_recogida',
    'observaciones',
    'foto',
    'estado',
    'id_voluntario_asignado',
    'id_ong_destino', 
];

    /**
     * Relación con el usuario comercio que creó la donación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Relación con el voluntario asignado a la donación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voluntario()
{
    return $this->belongsTo(User::class, 'id_voluntario_asignado', 'id_usuario');
}

    /**
     * Relación con los datos del comercio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comercio()
{
    return $this->belongsTo(Comercio::class, 'id_usuario', 'id_usuario');
}

/**
 * Relación con la ONG destino de la donación
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function ong()
{
    return $this->belongsTo(Usuario::class, 'id_ong_destino', 'id_usuario');
}


}
