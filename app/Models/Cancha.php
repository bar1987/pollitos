<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
