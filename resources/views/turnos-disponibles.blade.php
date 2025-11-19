<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver atrás
                </a>
                <h1 class="text-4xl font-bold text-gray-900">{{ $cancha->name }}</h1>
                <p class="text-gray-600 mt-2">📍 {{ $cancha->location }} • 🏟️ {{ $cancha->type }}</p>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Contenedor de selección de fecha y horarios -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Panel de Días -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Selecciona un día</h2>
                        <div class="space-y-2 max-h-96 overflow-y-auto">
                            @forelse($horariosFormateados as $nombreDia => $diaData)
                                <button type="button" 
                                        onclick="mostrarHorarios('{{ $nombreDia }}', this)"
                                        class="dia-btn w-full text-left p-3 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition duration-200 font-medium text-sm"
                                        data-fecha="{{ $nombreDia }}">
                                    <div class="text-gray-900">{{ $nombreDia }}</div>
                                    <div class="text-xs text-gray-500">{{ $diaData['diaSemana'] }}</div>
                                </button>
                            @empty
                                <p class="text-gray-500 text-sm">No hay horarios disponibles</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Panel de Horarios -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Horarios disponibles</h2>
                        
                        <div id="horariosContainer" class="text-center text-gray-500 py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Selecciona un día para ver los horarios disponibles
                        </div>

                        <!-- Datos ocultos de horarios -->
                        @foreach($horariosFormateados as $nombreDia => $diaData)
                            <div id="horarios-{{ $nombreDia }}" class="hidden">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @forelse($diaData['horarios'] as $horario)
                                        @php
                                            $horaInicio = $horario->hora_inicio;
                                            $horaFin = $horario->hora_fin;
                                            $estaReservado = in_array($horaInicio, $diaData['turnosReservados']);
                                        @endphp
                                        
                                        <form action="{{ route('reservar-turno') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="cancha_id" value="{{ $cancha->id }}">
                                            <input type="hidden" name="fecha" value="{{ $diaData['fecha']->format('Y-m-d') }}">
                                            <input type="hidden" name="hora_inicio" value="{{ $horaInicio }}">
                                            
                                            <button type="submit"
                                                    {{ $estaReservado ? 'disabled' : '' }}
                                                    class="w-full p-4 rounded-lg border-2 font-bold transition duration-200
                                                        {{ $estaReservado 
                                                            ? 'border-red-200 bg-red-50 text-red-400 cursor-not-allowed' 
                                                            : 'border-green-300 bg-green-50 text-green-700 hover:bg-green-100 hover:border-green-500 cursor-pointer' }}">
                                                <div>{{ $horaInicio }}</div>
                                                @if($horario->descripcion)
                                                    <div class="text-xs mt-1 opacity-75">{{ $horario->descripcion }}</div>
                                                @endif
                                                {{ $estaReservado ? '✗ Reservado' : '✓ Disponible' }}
                                            </button>
                                        </form>
                                    @empty
                                        <p class="col-span-full text-gray-500 text-center py-8">
                                            No hay horarios configurados para este día
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Información importante</h3>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>✓ Los horarios disponibles se muestran en verde</li>
                    <li>✗ Los horarios reservados se muestran en rojo</li>
                    <li>📅 Puedes reservar turnos para los próximos 30 días</li>
                    <li>🕐 Haz clic en un horario para completar tu reserva</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function mostrarHorarios(nombreDia, button) {
            // Ocultar todos los horarios
            document.querySelectorAll('[id^="horarios-"]').forEach(el => el.classList.add('hidden'));
            
            // Remover clase activa de todos los botones
            document.querySelectorAll('.dia-btn').forEach(btn => {
                btn.classList.remove('border-blue-600', 'bg-blue-100');
                btn.classList.add('border-gray-200');
            });
            
            // Mostrar horarios del día seleccionado
            const horariosElement = document.getElementById('horarios-' + nombreDia);
            if (horariosElement) {
                horariosElement.classList.remove('hidden');
                document.getElementById('horariosContainer').classList.add('hidden');
            }
            
            // Activar el botón clickeado
            button.classList.add('border-blue-600', 'bg-blue-100');
            button.classList.remove('border-gray-200');
        }
    </script>
</x-app-layout>
