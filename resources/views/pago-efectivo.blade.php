<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Reserva</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="javascript:history.back()" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Comprobante de Reserva</h1>
            </div>

            <!-- Comprobante Imprimible -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8 border-b-2 border-dashed border-gray-300">
                    <!-- Logo y Encabezado -->
                    <div class="text-center mb-8">
                        <div class="inline-block bg-green-600 text-white rounded-full p-3 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">TURNOSCANCHA</h2>
                        <p class="text-gray-600">Reserva de Cancha de Fútbol</p>
                    </div>

                    <!-- Número de Comprobante -->
                    <div class="text-center py-6 bg-green-50 rounded-lg mb-8 border-2 border-green-200">
                        <p class="text-gray-600 text-xs font-semibold">NÚMERO DE RESERVA</p>
                        <p class="text-5xl font-bold text-green-600 font-mono">{{ strtoupper(substr(md5($datos['nombre'] . time()), 0, 8)) }}</p>
                        <p class="text-xs text-gray-500 mt-2">Presenta este código en la cancha</p>
                    </div>

                    <!-- Datos del Cliente -->
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 pb-2 border-b-2 border-gray-200">DATOS DE LA RESERVA</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">NOMBRE</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $datos['nombre'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">EMAIL</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $datos['email'] }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-600 font-semibold">TELÉFONO</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $datos['telefono'] }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-600 font-semibold">MÉTODO DE PAGO</p>
                                <p class="text-lg font-semibold text-gray-900">💵 Efectivo en Cancha</p>
                            </div>
                        </div>
                    </div>

                    <!-- Monto a Pagar -->
                    <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-6 mb-8">
                        <p class="text-center text-gray-600 text-sm font-semibold mb-2">MONTO A PAGAR EN LA CANCHA</p>
                        <p class="text-center text-5xl font-bold text-yellow-600">${{ number_format($datos['precio'], 2) }}</p>
                        <p class="text-center text-xs text-gray-500 mt-3">Paga este monto cuando llegues a la cancha</p>
                    </div>

                    <!-- Términos -->
                    <div class="text-center text-xs text-gray-600 space-y-1">
                        <p>Esta es tu confirmación de reserva</p>
                        <p>Se te enviará un email adicional con todos los detalles</p>
                        <p class="pt-2">Para cambios o cancelaciones, contáctanos antes de 2 horas de tu reserva</p>
                    </div>
                </div>

                <!-- Pie con información de contacto -->
                <div class="bg-gray-900 text-white p-6 text-center">
                    <p class="font-semibold mb-2">¿Preguntas o cambios?</p>
                    <p class="text-sm text-gray-300">📧 Email: info@turnoscancha.com | 📱 Teléfono: +54 11 2000-0000</p>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 no-print">
                <!-- Botón Imprimir -->
                <button 
                    onclick="window.print()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Imprimir Comprobante
                </button>

                <!-- Botón Confirmar -->
                <form action="{{ route('confirmar-pago') }}" method="POST" class="w-full">
                    @csrf
                    <button 
                        type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Confirmar Reserva
                    </button>
                </form>
            </div>

            <!-- Nota adicional -->
            <div class="mt-6 p-4 bg-gray-100 rounded-lg text-center text-gray-700 no-print">
                <p class="text-sm">
                    <strong>Importante:</strong> No olvides traer este comprobante o presentar el código de reserva cuando llegues a la cancha.
                </p>
            </div>
        </div>
    </div>

    <style media="print">
        body {
            background: white;
        }
        .bg-gray-50 {
            background: white !important;
        }
        .no-print, .botones-accion {
            display: none !important;
        }
    </style>
</body>
</html>
