<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorariosSeeder extends Seeder
{
    /**
     * Seed de horarios de trabajo.
     * Crea franjas horarias de 1 hora desde las 9:00 hasta las 23:00
     * para todos los días de la semana.
     */
    public function run(): void
    {
        // Limpiar horarios existentes (opcional)
        Horario::truncate();

        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $horaInicio = 9;  // 9:00 AM
        $horaFin = 23;    // 11:00 PM

        foreach ($dias as $dia) {
            for ($hora = $horaInicio; $hora < $horaFin; $hora++) {
                Horario::create([
                    'dia' => $dia,
                    'hora_inicio' => sprintf('%02d:00', $hora),
                    'hora_fin' => sprintf('%02d:00', $hora + 1),
                    'activo' => true,
                    'descripcion' => null,
                ]);
            }
        }

        $totalHorarios = count($dias) * ($horaFin - $horaInicio);
        $this->command->info("Se crearon {$totalHorarios} horarios exitosamente!");
        $this->command->info("Días: Lunes a Domingo");
        $this->command->info("Horario: 09:00 a 23:00 (franjas de 1 hora)");
    }
}
