@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Migas de pan / regreso --}}
        <div class="mb-4">
            <a href="{{ url('/register') }}" class="text-sm text-sky-600 hover:underline flex items-center gap-1">
                <span>←</span>
                <span>Volver al inicio</span>
            </a>
        </div>

        {{-- Encabezado --}}
        <div class="bg-white rounded-2xl shadow p-6 md:p-8 mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                Aviso de Privacidad
            </h1>
            <p class="text-sm text-gray-500">
                Última actualización: {{ now()->format('d/m/Y') }}
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
               Al registrarte en Rappitec, aceptas que la información proporcionada (nombre, correo, contraseña, teléfono, número de control y demás datos) será recopilada, almacenada y tratada conforme a nuestro Aviso de Privacidad y Términos de Servicio.
              Tu información será utilizada únicamente para crear tu cuenta, gestionar tus pedidos, mejorar tu experiencia dentro de la aplicación y permitir la interacción entre compradores y vendedores.

              Nos comprometemos a proteger tus datos personales, evitar accesos no autorizados y no compartirlos con terceros, excepto cuando sea estrictamente necesario para cumplir con obligaciones legales o cuando tú lo autorices expresamente.

            Si no aceptas estas condiciones, no será posible completar tu registro.
            </p>
        </div>

@endsection
