<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';
    protected $primaryKey = 'id';

    

    protected $fillable = [
        'id_usuario',
        'tipo_comida',
        'cantidad',
        'fecha_hora',
        'punto_recogida',
        'observaciones',
        'foto',
        'estado',
        'id_voluntario_asignado'
    ];
    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function voluntario()
    {
        return $this->belongsTo(User::class, 'id_voluntario_asignado', 'id_usuario');
    }

    public function comercio()
{
    return $this->hasOne(Comercio::class, 'id_usuario', 'id_usuario');
}

}
