<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use App\Models\Horario;
use App\Models\Turno;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TurnosDisponiblesController extends Controller
{
    /**
     * Mostrar los horarios disponibles para una cancha específica
     */
    public function show($canchaId)
    {
        // Obtener la cancha
        $cancha = Cancha::findOrFail($canchaId);

        // Obtener los horarios activos de la tabla horarios
        // Usar where() en lugar de scope active()
        $horarios = Horario::where('activo', true)
            ->orderBy('dia')
            ->get();

        // Generar próximos 30 días
        $diasDisponibles = [];
        for ($i = 0; $i < 30; $i++) {
            $fecha = Carbon::now()->addDays($i);
            $diaSemana = $this->obtenerDiaSemana($fecha->dayOfWeek);
            
            $diasDisponibles[] = [
                'fecha' => $fecha,
                'diaSemana' => $diaSemana,
                'nombreDia' => $fecha->format('d/m/Y'),
            ];
        }

        // Para cada día, obtener los horarios disponibles
        $horariosFormateados = [];
        foreach ($diasDisponibles as $dia) {
            $horariosDelDia = $horarios->where('dia', $dia['diaSemana'])->values();
            
            if ($horariosDelDia->isNotEmpty()) {
                $horariosFormateados[$dia['nombreDia']] = [
                    'fecha' => $dia['fecha'],
                    'diaSemana' => $dia['diaSemana'],
                    'horarios' => $horariosDelDia,
                    'turnosReservados' => $this->obtenerTurnosReservados($canchaId, $dia['fecha']),
                ];
            }
        }

        return view('turnos-disponibles', [
            'cancha' => $cancha,
            'horariosFormateados' => $horariosFormateados,
        ]);
    }

    /**
     * Obtener los turnos ya reservados para una cancha en una fecha específica
     */
    private function obtenerTurnosReservados($canchaId, $fecha)
    {
        $fechaInicio = $fecha->clone()->startOfDay();
        $fechaFin = $fecha->clone()->endOfDay();

        return Turno::where('cancha_id', $canchaId)
            ->whereBetween('start_datetime', [$fechaInicio, $fechaFin])
            ->get()
            ->map(function ($turno) {
                return $turno->start_datetime->format('H:i');
            })
            ->toArray();
    }

    /**
     * Convertir número de día de semana a nombre en español
     */
    private function obtenerDiaSemana($dayOfWeek)
    {
        $dias = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];

        return $dias[$dayOfWeek];
    }

    /**
     * Procesar la reserva de un turno
     */
    public function reservar(Request $request)
    {
        $validated = $request->validate([
            'cancha_id' => 'required|exists:canchas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        // Crear el turno
        $turno = Turno::create([
            'cancha_id' => $validated['cancha_id'],
            'client_id' => auth()->id(),
            'start_datetime' => Carbon::parse($validated['fecha'] . ' ' . $validated['hora_inicio']),
        ]);

        return redirect()->back()->with('success', 'Turno reservado exitosamente');
    }
}
