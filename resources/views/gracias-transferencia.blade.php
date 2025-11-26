<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Gracias por tu Reserva!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full">
            <!-- Card principal -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Encabezado con gradiente -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-12 text-center">
                    <!-- Ícono de checkmark animado -->
                    <div class="flex justify-center mb-6">
                        <div class="relative w-24 h-24">
                            <svg class="w-full h-full text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <h1 class="text-4xl font-bold text-white mb-2">¡Gracias!</h1>
                    <p class="text-green-100 text-lg">Tu transferencia ha sido registrada</p>
                </div>

                <!-- Contenido -->
                <div class="px-8 py-12">
                    <!-- Mensaje principal -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Tu Reserva está Pendiente de Confirmación</h2>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Hemos recibido tu confirmación de transferencia. Nuestro equipo verificará el pago en las próximas 
                            <span class="font-bold text-green-600">24-48 horas</span> 
                            y confirmará tu reserva por correo electrónico.
                        </p>
                    </div>

                    <!-- Información importante -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Datos de la Cancha -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v4a1 1 0 11-2 0V4H4v10h4a1 1 0 110 2H4a2 2 0 01-2-2V4z" />
                                </svg>
                                Cancha Reservada
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <strong>Nombre:</strong> {{ $datos_pago['cancha_nombre'] ?? 'Tu cancha' }}
                            </p>
                            <p class="text-gray-600 text-sm mt-1">
                                <strong>Fecha:</strong> {{ $datos_pago['fecha'] ?? 'Sin especificar' }}
                            </p>
                            <p class="text-gray-600 text-sm mt-1">
                                <strong>Hora:</strong> {{ $datos_pago['hora_inicio'] ?? 'Sin especificar' }}
                            </p>
                        </div>

                        <!-- Datos del Pago -->
                        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                Detalles del Pago
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <strong>Método:</strong> Transferencia Bancaria
                            </p>
                            <p class="text-gray-600 text-sm mt-1">
                                <strong>Estado:</strong> <span class="text-yellow-600 font-bold">Pendiente de Verificación</span>
                            </p>
                            <p class="text-gray-600 text-sm mt-1">
                                <strong>Monto:</strong> <span class="text-2xl font-bold text-green-600">${{ number_format($datos_pago['precio'] ?? 0, 2) }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Qué esperar -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                            </svg>
                            Próximos Pasos
                        </h3>
                        <ol class="list-decimal list-inside space-y-2 text-gray-600">
                            <li>Verificaremos tu transferencia en la cuenta bancaria</li>
                            <li>Una vez confirmado, recibirás un email de confirmación</li>
                            <li>Tu turno será registrado como completado en el sistema</li>
                            <li>Podrás ver tu reserva en el dashboard</li>
                        </ol>
                    </div>

                    <!-- Datos de Contacto -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
                        <h3 class="font-bold text-gray-900 mb-3">📧 Confirmación Enviada a</h3>
                        <p class="text-lg font-mono text-gray-900">{{ $datos_pago['email'] ?? 'tu@email.com' }}</p>
                        <p class="text-sm text-gray-600 mt-2">
                            Si no recibes el email en 30 minutos, revisa tu carpeta de spam o contáctanos.
                        </p>
                    </div>

                    <!-- Botones de acción -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('welcome') }}" class="block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-200">
                            Volver al Inicio
                        </a>
                        <a href="{{ route('dashboard') }}" class="block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-200">
                            Ver Dashboard
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 border-t border-gray-200 px-8 py-6 text-center text-sm text-gray-600">
                    <p>
                        <strong>TurnosCancha</strong> - Reserva de Canchas de Fútbol
                    </p>
                    <p class="mt-2">
                        Si tienes preguntas, no dudes en contactarnos por email o teléfono.
                    </p>
                </div>
            </div>

            <!-- Elemento decorativo -->
            <div class="mt-8 text-center">
                <div class="inline-block">
                    <svg class="w-32 h-32 text-green-200 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
