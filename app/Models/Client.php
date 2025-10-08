<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional, porque Laravel lo deduce como "clients")
    protected $table = 'clients';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];
}
