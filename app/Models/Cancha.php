<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cancha extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional, Laravel lo infiere en plural "canchas")
    protected $table = 'canchas';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'type',
        'location',
        'user_id',
        'precio',
    ];

    /**
     * Relación: Una cancha pertenece a un usuario (propietario)
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Una cancha tiene muchos turnos
     */
    public function turnos(): HasMany
    {
        return $this->hasMany(Turno::class);
    }
}
