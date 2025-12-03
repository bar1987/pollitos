<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'turno_id',
        'descripcion',
    ];

    /**
     * Relación: un pago pertenece a un turno.
     */
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
