<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver al inicio
                </a>
                <h1 class="text-4xl font-bold text-gray-900">📅 Mis Turnos</h1>
                <p class="text-gray-600 mt-2">Aquí puedes ver todos tus turnos agendados</p>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Lista de Turnos -->
            <div class="space-y-4">
                @forelse($turnos as $turno)
                    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 
                        {{ $turno->start_datetime->isPast() ? 'border-gray-400' : 'border-green-500' }}">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-2xl">🏟️</span>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $turno->cancha->name }}</h3>
                                    @if($turno->start_datetime->isPast())
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-600 rounded-full">
                                            Pasado
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                            Próximo
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span>📍</span>
                                        <span>{{ $turno->cancha->location }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>📆</span>
                                        <span class="font-semibold">{{ $turno->start_datetime->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>🕐</span>
                                        <span class="font-semibold text-blue-600">{{ $turno->start_datetime->format('H:i') }} hs</span>
                                    </div>
                                </div>
                            </div>
                            
                            @if(!$turno->start_datetime->isPast())
                                <div class="mt-4 md:mt-0 md:ml-4">
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500">Faltan</p>
                                        <p class="text-lg font-bold text-blue-600">
                                            {{ $turno->start_datetime->diffForHumans(['parts' => 2]) }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                        <div class="text-6xl mb-4">📭</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes turnos agendados</h3>
                        <p class="text-gray-600 mb-6">¡Reserva tu primer turno ahora!</p>
                        <a href="{{ route('welcome') }}" 
                           class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                            🏟️ Ver Canchas Disponibles
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Paginación si hay muchos turnos -->
            @if($turnos->hasPages())
                <div class="mt-6">
                    {{ $turnos->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
