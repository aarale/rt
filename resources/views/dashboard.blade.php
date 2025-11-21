<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RAPPITEC</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- NAV -->
    <nav class="w-full bg-white shadow-sm py-4 px-8 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logorappitec.png') }}" class="w-10" alt="">
            <span class="text-xl font-bold text-indigo-600">RAPPITEC</span>
        </div>

        <div>
            @guest
                <a href="{{ route('login') }}"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 font-semibold hover:bg-indigo-50 ml-2">
                    Crear cuenta
                </a>
            @endguest

            @auth
                @if(auth()->user()->hasRole('seller'))
                    <a href="/seller/dashboard"
                       class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                       Ir al dashboard
                    </a>
                @else
                    <a href="/catalog"
                       class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                       Ir al dashboard
                    </a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- HERO -->
    <section class="text-center mt-20 px-6">
        <h1 class="text-5xl font-extrabold text-gray-900">Conecta con los negocios del Tec</h1>

        <p class="mt-4 text-gray-600 text-lg max-w-2xl mx-auto">
            Haz pedidos rápidos, evita filas y recoge cuando tú quieras.
        </p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('register') }}"
               class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold text-lg hover:bg-indigo-700">
                Crear cuenta
            </a>

            <a href="{{ route('login') }}"
               class="px-6 py-3 rounded-xl border border-gray-400 text-gray-700 font-semibold text-lg hover:bg-gray-100">
                Ya tengo cuenta
            </a>
        </div>

        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/delivery-rabbit-3d-icon-10974740.png"
             class="w-64 mx-auto mt-12 drop-shadow-xl" />
    </section>

</body>
</html>
