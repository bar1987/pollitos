<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'dia',          // e.g. 'Lunes', 'Martes' or numeric day
        'hora_inicio',  // stored as TIME or DATETIME (format H:i)
        'hora_fin',
        'activo',
        'descripcion',
    ];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin'    => 'datetime:H:i',
        'activo'      => 'boolean',
    ];

    /**
     * Scope: only active horarios
     */
    public function scopeActive($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope: filter by day
     */
    public function scopeForDay($query, $dia)
    {
        return $query->where('dia', $dia);
    }

    /**
     * Accessor: duration in minutes between hora_inicio and hora_fin.
     * If hora_fin is earlier than or equal to hora_inicio, it's assumed to be next day.
     */
    public function getDurationAttribute()
    {
        if (!$this->hora_inicio || !$this->hora_fin) {
            return null;
        }

        $start = Carbon::parse($this->hora_inicio);
        $end = Carbon::parse($this->hora_fin);

        if ($end->lte($start)) {
            $end->addDay();
        }

        return $start->diffInMinutes($end);
    }

    // Relaciones ejemplo
    // public function curso()
    // {
    //     return $this->belongsTo(Curso::class);
    // }
}