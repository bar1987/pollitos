<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use App\Models\Client;
use App\Models\Configuracion;
use App\Models\Horario;
use App\Models\Pago;
use App\Models\Turno;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TurnosDisponiblesController extends Controller
{
    /**
     * Mostrar página de inicio con todas las canchas
     */
    public function index()
    {
        $canchas = Cancha::all();
        return view('home', [
            'canchas' => $canchas,
        ]);
    }

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
     * Procesar la reserva de un turno - Mostrar formulario de pago
     */
    public function reservar(Request $request)
    {
        $validated = $request->validate([
            'cancha_id' => 'required|exists:canchas,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        $cancha = Cancha::findOrFail($validated['cancha_id']);
        $precio = $cancha->precio ?? 150; // Usar precio de la cancha o 150 por defecto

        // Guardar en sesión
        session([
            'turno_pendiente' => [
                'cancha_id' => $validated['cancha_id'],
                'fecha' => $validated['fecha'],
                'hora_inicio' => $validated['hora_inicio'],
            ]
        ]);

        return view('pago', [
            'cancha' => $cancha,
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'precio' => $precio,
        ]);
    }

    /**
     * Procesar el pago - Redirigir según método
     */
    public function procesarPago(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'precio' => 'required|numeric',
            'metodo_pago' => 'required|in:transferencia,efectivo',
        ]);

        // Guardar en sesión todos los datos
        session([
            'datos_pago' => [
                'nombre' => $validated['nombre'],
                'email' => $validated['email'],
                'telefono' => $validated['telefono'],
                'precio' => $validated['precio'],
                'metodo_pago' => $validated['metodo_pago'],
            ]
        ]);

        // Redirigir según método de pago
        if ($validated['metodo_pago'] === 'transferencia') {
            return redirect()->route('pago-transferencia');
        } else {
            return redirect()->route('pago-efectivo');
        }
    }

    /**
     * Mostrar formulario de pago por transferencia
     */
    public function pagoTransferencia()
    {
        $datos = session('datos_pago');
        if (!$datos) {
            return redirect('/')->with('error', 'No hay datos de pago');
        }

        return view('pago-transferencia', [
            'datos' => $datos,
        ]);
    }

    /**
     * Mostrar comprobante de efectivo
     */
    public function pagoEfectivo()
    {
        $datos = session('datos_pago');
        if (!$datos) {
            return redirect('/')->with('error', 'No hay datos de pago');
        }

        return view('pago-efectivo', [
            'datos' => $datos,
        ]);
    }

    /**
     * Confirmar pago y crear turno
     */
    public function confirmarPago(Request $request)
    {
        $turno_pendiente = session('turno_pendiente');
        $datos_pago = session('datos_pago');
        
        if (!$turno_pendiente || !$datos_pago) {
            return redirect('/')->with('error', 'Datos de pago incompletos');
        }

        // Crear o obtener cliente
        $client = Client::firstOrCreate(
            ['email' => $datos_pago['email']],
            [
                'first_name' => $datos_pago['nombre'],
                'last_name' => '',
                'email' => $datos_pago['email'],
            ]
        );

        // Crear turno
        $turno = Turno::create([
            'cancha_id' => $turno_pendiente['cancha_id'],
            'client_id' => $client->id,
            'start_datetime' => Carbon::parse($turno_pendiente['fecha'] . ' ' . $turno_pendiente['hora_inicio']),
        ]);

        // Crear pago
        $pago = Pago::create([
            'turno_id' => $turno->id,
            'monto' => $datos_pago['precio'],
            'metodo_pago' => $datos_pago['metodo_pago'],
            'estado' => 'completado',
        ]);

        // Limpiar sesión
        session()->forget(['turno_pendiente', 'datos_pago']);

        return redirect()->route('welcome')->with('success', 'Pago confirmado exitosamente. Tu turno ha sido registrado.');
    }

    /**
     * Mostrar confirmación del turno
     */
    public function confirmacionTurno($turnoId)
    {
        $turno = Turno::with('cancha', 'client', 'pago')->findOrFail($turnoId);

        return view('confirmacion-turno', [
            'turno' => $turno,
        ]);
    }
}

