<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
    <!-- Header -->
    <div class="max-w-7xl mx-auto">
        <div class="mb-12 flex items-center gap-4">
            <img src="{{ asset('images/logo/Logo final.png') }}" alt="TurnosCancha Logo" class="h-16 w-auto">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-0">
                    Mi Dashboard - Reserva una Cancha
                </h1>
                <p class="text-lg text-gray-600">
                    Selecciona una cancha disponible y elige tu turno favorito
                </p>
            </div>
        </div>

        <!-- Canchas Grid -->
        @php
            $canchas = \App\Models\Cancha::all();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($canchas as $cancha)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Cancha Image Header with Football Theme -->
                    @if($cancha->photo_path)
                        <div class="relative h-32 bg-cover bg-center flex items-center justify-center overflow-hidden" style="background-image: url('{{ asset('storage/' . $cancha->photo_path) }}')">
                            <!-- Overlay para mejor legibilidad -->
                            <div class="absolute inset-0 bg-black opacity-20"></div>
                    @else
                        <div class="relative h-32 bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center overflow-hidden">
                            <!-- Fondo de patrón de cancha -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 60" preserveAspectRatio="none">
                                    <!-- Líneas de cancha -->
                                    <rect x="0" y="0" width="100" height="60" fill="none" stroke="white" stroke-width="1"/>
                                    <line x1="50" y1="0" x2="50" y2="60" stroke="white" stroke-width="1"/>
                                    <circle cx="50" cy="30" r="8" fill="none" stroke="white" stroke-width="1"/>
                                    <rect x="5" y="20" width="15" height="20" fill="none" stroke="white" stroke-width="1"/>
                                    <rect x="80" y="20" width="15" height="20" fill="none" stroke="white" stroke-width="1"/>
                                </svg>
                            </div>
                    @endif

                        <!-- Balón de fútbol animado -->
                        <div class="absolute top-2 right-2 animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="11" stroke="white" stroke-width="0.5" fill="white"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
                            </svg>
                        </div>

                        <!-- Tipo de cancha badge -->
                        <div class="absolute top-2 left-2 bg-white bg-opacity-90 px-2 py-1 rounded text-xs font-bold text-blue-600">
                            {{ $cancha->type }}
                        </div>

                        <!-- Icono principal -->
                        <div class="relative z-10">
                            <svg class="w-12 h-12 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.788l-1.314.657 1.314.657a1 1 0 11-.894 1.788l-1.599-.799-3.954 1.581V16a1 1 0 11-2 0v-1.323L6.046 12.595l-1.599.799a1 1 0 11-.894-1.788l1.314-.657-1.314-.657a1 1 0 01.894-1.788l1.599.8L8 5.323V4a1 1 0 011-1h1V3z" />
                            </svg>
                        </div>
                    </div>                    <!-- Cancha Info -->
                    <div class="p-4">
                        <h4 class="text-lg font-bold text-gray-900 mb-1">
                            ⚽ {{ $cancha->name }}
                        </h4>
                        
                        <div class="space-y-1 mb-2 text-xs text-gray-600">
                            <p class="flex items-center">
                                <span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></span>
                                <span class="font-semibold">{{ $cancha->type }}</span>
                            </p>
                            <p class="flex items-center">
                                <span class="inline-block w-1.5 h-1.5 bg-blue-500 rounded-full mr-1"></span>
                                <span>{{ $cancha->location }}</span>
                            </p>
                        </div>

                        <!-- Rating y info adicional -->
                        <div class="mb-2 pb-2 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm">★★★★★</span>
                                    <span class="text-gray-500 text-xs ml-1">(4.8)</span>
                                </div>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">
                                    ✓ Disponible
                                </span>
                            </div>
                        </div>

                        <!-- Precio destacado -->
                        <div class="mb-3">
                            <p class="text-gray-600 text-xs mb-0.5">Precio por hora</p>
                            <p class="text-2xl font-bold text-blue-600">
                                ${{ number_format($cancha->precio, 0) }}
                            </p>
                        </div>

                        <!-- Características -->
                        <div class="mb-3 grid grid-cols-2 gap-1">
                            <div class="bg-blue-50 p-1.5 rounded text-center {{ $cancha->tiene_luz_led ? 'border-2 border-blue-400' : 'opacity-50' }}">
                                <p class="text-xs text-gray-600">Luz LED</p>
                                <p class="text-xs font-bold {{ $cancha->tiene_luz_led ? 'text-blue-600' : 'text-gray-400' }}">
                                    {{ $cancha->tiene_luz_led ? '✓' : '✗' }}
                                </p>
                            </div>
                            <div class="bg-blue-50 p-1.5 rounded text-center {{ $cancha->tiene_vestuarios ? 'border-2 border-blue-400' : 'opacity-50' }}">
                                <p class="text-xs text-gray-600">Vestuarios</p>
                                <p class="text-xs font-bold {{ $cancha->tiene_vestuarios ? 'text-blue-600' : 'text-gray-400' }}">
                                    {{ $cancha->tiene_vestuarios ? '✓' : '✗' }}
                                </p>
                            </div>
                            <div class="bg-blue-50 p-1.5 rounded text-center {{ $cancha->tiene_estacionamiento ? 'border-2 border-blue-400' : 'opacity-50' }}">
                                <p class="text-xs text-gray-600">Estacionamiento</p>
                                <p class="text-xs font-bold {{ $cancha->tiene_estacionamiento ? 'text-blue-600' : 'text-gray-400' }}">
                                    {{ $cancha->tiene_estacionamiento ? '✓' : '✗' }}
                                </p>
                            </div>
                            <div class="bg-blue-50 p-1.5 rounded text-center">
                                <p class="text-xs text-gray-600">Césped</p>
                                <p class="text-xs font-bold text-blue-600">
                                    {{ $cancha->tipo_cesped === 'sintetico' ? 'Sint.' : 'Real' }}
                                </p>
                            </div>
                        </div>

                        <!-- Botón -->
                        <a href="{{ route('turnos-disponibles', $cancha->id) }}" 
                           class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2 px-3 rounded-lg transition duration-200 inline-block text-center flex items-center justify-center gap-1 text-sm">
                            ⚽ Ver Turnos
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-lg shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 3a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.788l-1.314.657 1.314.657a1 1 0 11-.894 1.788l-1.599-.799-3.954 1.581V16a1 1 0 11-2 0v-1.323L6.046 12.595l-1.599.799a1 1 0 11-.894-1.788l1.314-.657-1.314-.657a1 1 0 01.894-1.788l1.599.8L8 5.323V4a1 1 0 011-1h1V3z" />
                    </svg>
                    <p class="text-gray-600 font-semibold text-lg">No hay canchas disponibles en este momento</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
