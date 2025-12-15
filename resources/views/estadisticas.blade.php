<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver al inicio
                </a>
                <h1 class="text-4xl font-bold text-gray-900">📊 Estadísticas</h1>
                <p class="text-gray-600 mt-2">Resumen de los alquileres de canchas</p>
            </div>

            <!-- Tarjetas de resumen -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Turnos -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <span class="text-2xl">📅</span>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total de Turnos</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalTurnos }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ganancias -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <span class="text-2xl">💰</span>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Ganancias Totales</p>
                            <p class="text-3xl font-bold text-green-600">${{ number_format($gananciasTotales, 0) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Cancha más popular -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <span class="text-2xl">⭐</span>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Cancha Más Popular</p>
                            <p class="text-xl font-bold text-gray-900">{{ $canchaMasPopular ?? 'Sin datos' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de turnos por cancha -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Turnos por Cancha</h2>
                <canvas id="turnosPorCanchaChart" height="100"></canvas>
            </div>

            <!-- Tabla de detalle -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Detalle por Cancha</h2>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-3 px-4">Cancha</th>
                            <th class="text-left py-3 px-4">Turnos</th>
                            <th class="text-left py-3 px-4">Precio/Hora</th>
                            <th class="text-left py-3 px-4">Ganancias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estadisticasPorCancha as $estadistica)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium">{{ $estadistica['nombre'] }}</td>
                                <td class="py-3 px-4">{{ $estadistica['turnos'] }}</td>
                                <td class="py-3 px-4">${{ number_format($estadistica['precio'], 0) }}</td>
                                <td class="py-3 px-4 text-green-600 font-bold">${{ number_format($estadistica['ganancias'], 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">No hay datos disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico
        const labels = @json($nombresCancha);
        const data = @json($turnosPorCancha);

        // Crear gráfico de barras
        new Chart(document.getElementById('turnosPorCanchaChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Turnos',
                    data: data,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(239, 68, 68)',
                        'rgb(139, 92, 246)',
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 60,
                    maxBarThickness: 80,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
