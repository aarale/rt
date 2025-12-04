@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6 text-center">

    <h1 class="text-3xl font-bold mb-4">Membresía Mensual 💎</h1>

    <p class="text-gray-600 mb-6">
       La Membresía Mensual te otorga el permiso oficial de la universidad para realizar ventas dentro del campus. Con esta membresía puedes ofrecer tus productos o servicios de forma autorizada, segura y regulada. Obtén acceso a herramientas exclusivas para vendedores, mayor visibilidad, reportes de ventas y soporte especializado para impulsar tu negocio dentro de la comunidad estudiantil.
    </p>

    @if (auth()->user()->is_subscribed)
        <p class="text-green-600 font-semibold">Ya tienes una suscripción activa 🎉</p>
    @else
        <form action="{{ route('subscribe.create') }}" method="POST">
            @csrf
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Suscribirme por $99 MXN/mes
            </button>
        </form>
    @endif
</div>
@endsection
