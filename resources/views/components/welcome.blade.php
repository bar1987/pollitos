<div class="p-6 lg:p-8 bg-white">
    <!-- Header con título y localización -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">TURNO CANCHA SR</h1>
        </div>
    </div>

    <!-- Localización -->
    <div class="flex items-center mb-6 text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
        </svg>
        <span class="font-semibold">San Rafael, Mendoza</span>
    </div>

    <!-- Lista de canchas -->
    <div class="space-y-4">
        @php
            $canchas = \App\Models\Cancha::all();
        @endphp

        @forelse($canchas as $cancha)
            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-3xl hover:border-blue-600 hover:shadow-md transition duration-200">
                <div class="flex items-center space-x-3 flex-grow">
                    <!-- Ícono de cancha -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2zm4-4a1 1 0 11-2 0 1 1 0 012 0zm1 0a1 1 0 100-2 1 1 0 000 2zm-1 4a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>

                    <!-- Información de la cancha -->
                    <div class="flex-grow">
                        <h3 class="font-semibold text-gray-900">{{ $cancha->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $cancha->location }}</p>
                        <p class="text-xs text-gray-500">{{ $cancha->type }}</p>
                    </div>
                </div>

                <!-- Botón -->
                <a href="{{ route('turnos-disponibles', $cancha->id) }}" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full transition duration-200 text-sm whitespace-nowrap inline-block">
                    Ver turnos disponibles
                </a>
            </div>
        @empty
            <div class="p-6 bg-gray-100 rounded-3xl text-center">
                <p class="text-gray-600 font-semibold">No hay canchas disponibles en este momento.</p>
            </div>
        @endforelse
    </div>
</div>
