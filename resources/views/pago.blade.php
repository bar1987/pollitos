<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago de Turno</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Confirmar Turno</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Resumen del Turno -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Resumen</h2>
                        
                        <div class="space-y-4 mb-6 pb-6 border-b">
                            <div>
                                <p class="text-gray-600 text-sm">Cancha</p>
                                <p class="font-semibold text-gray-900">{{ $cancha->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-600 text-sm">Fecha</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-600 text-sm">Horario</p>
                                <p class="font-semibold text-gray-900">{{ substr($hora_inicio, 0, 5) }}</p>
                            </div>
                        </div>

                        <div class="text-center py-4 bg-gray-50 rounded">
                            <p class="text-gray-600 text-sm">Total a Pagar</p>
                            <p class="text-4xl font-bold text-blue-600">${{ number_format($precio, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Pago -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Datos de Contacto</h2>

                        <form action="{{ route('procesar-pago') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre Completo *
                                </label>
                                <input 
                                    type="text" 
                                    name="nombre" 
                                    id="nombre"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                @error('nombre')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email *
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                @error('email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                                    Teléfono *
                                </label>
                                <input 
                                    type="tel" 
                                    name="telefono" 
                                    id="telefono"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                @error('telefono')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="metodo_pago" class="block text-sm font-medium text-gray-700 mb-2">
                                    Método de Pago *
                                </label>
                                <select 
                                    name="metodo_pago" 
                                    id="metodo_pago"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                    <option value="">Selecciona un método</option>
                                    <option value="transferencia">🏦 Transferencia Bancaria</option>
                                    <option value="efectivo">💵 Efectivo en el Sitio</option>
                                </select>
                                @error('metodo_pago')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Campo oculto con precio -->
                            <input type="hidden" name="precio" value="{{ $precio }}">

                            <button 
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200"
                            >
                                Confirmar Pago - ${{ number_format($precio, 2) }}
                            </button>
                        </form>

                        <div class="mt-6 pt-6 border-t text-center text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            Tu información está segura y protegida
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
