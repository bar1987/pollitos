<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago por Transferencia</title>
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
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo/Logo final.png') }}" alt="TurnosCancha Logo" class="h-12 w-auto">
                    <h1 class="text-3xl font-bold text-gray-900">Pago por Transferencia Bancaria</h1>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Resumen -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Resumen</h2>
                        
                        <div class="space-y-3 pb-4 border-b">
                            <div>
                                <p class="text-gray-600 text-xs">NOMBRE</p>
                                <p class="font-semibold text-gray-900">{{ $datos['nombre'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-600 text-xs">EMAIL</p>
                                <p class="font-semibold text-gray-900">{{ $datos['email'] }}</p>
                            </div>
                        </div>

                        <div class="text-center py-4 bg-gray-50 rounded mt-4">
                            <p class="text-gray-600 text-sm">TOTAL A PAGAR</p>
                            <p class="text-4xl font-bold text-blue-600">${{ number_format($datos['precio'], 2) }}</p>
                        </div>

                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-xs text-yellow-800">
                            <p class="font-semibold mb-1">Plazo de confirmación</p>
                            <p>Usualmente se confirma en 24-48 horas</p>
                        </div>
                    </div>
                </div>

                <!-- Información de Transferencia -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">🏦 Datos de la Cuenta Bancaria</h2>

                        <div class="space-y-4 mb-6">
                            <!-- Banco -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200">
                                <p class="text-gray-600 text-xs font-semibold">BANCO</p>
                                <p class="text-2xl font-bold text-blue-600">Banco de Crédito</p>
                            </div>

                            <!-- CBU -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold mb-1">CBU</p>
                                <div class="flex items-center justify-between">
                                    <code class="text-lg font-mono font-bold text-gray-900">0070070123456789012345</code>
                                    <button type="button" onclick="copyToClipboard('0070070123456789012345', this)" class="text-blue-600 hover:text-blue-800 ml-2 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Cuenta -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold mb-1">NÚMERO DE CUENTA</p>
                                <div class="flex items-center justify-between">
                                    <code class="text-lg font-mono font-bold text-gray-900">123456789</code>
                                    <button type="button" onclick="copyToClipboard('123456789', this)" class="text-blue-600 hover:text-blue-800 ml-2 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Monto -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-gray-600 text-xs font-semibold mb-1">MONTO A TRANSFERIR</p>
                                <p class="text-3xl font-bold text-blue-600">${{ number_format($datos['precio'], 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmación -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">✅ Confirmar Transferencia</h2>
                        
                        <p class="text-gray-600 mb-6">
                            Una vez realizada la transferencia, haz click en el botón de abajo para confirmar. Tu reserva será registrada de forma pendiente hasta que confirmemos el pago.
                        </p>

                        <form action="{{ route('confirmar-pago') }}" method="POST">
                            @csrf

                            <button 
                                type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center mb-4"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Confirmar Transferencia Realizada
                            </button>
                        </form>

                        <div class="p-3 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
                            <p><strong>💡 Nota:</strong> Después de confirmar, recibirás un email con los detalles de tu reserva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalHTML = button.innerHTML;
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
                button.classList.add('text-green-600');
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('text-green-600');
                }, 2000);
            });
        }
    </script>
</body>
</html>
