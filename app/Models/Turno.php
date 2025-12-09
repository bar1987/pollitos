<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'user_id',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
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

    /**
     * Relación con Usuario autenticado
     * Un turno pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
