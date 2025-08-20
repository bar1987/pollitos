<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
 use HasFactory;

    // Tabla asociada
    protected $table = 'turnos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'start_datetime',
        'cancha_id',
        'client_id',
    ];

    /**
     * Relación con Cancha
     * Un turno pertenece a una cancha
     */
    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }

    /**
     * Relación con Cliente
     * Un turno pertenece a un cliente
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
