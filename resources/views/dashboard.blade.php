<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RAPPITEC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sky-100 from-indigo-50 to-white text-gray-900 antialiased">
    
    <nav class="w-full bg-white shadow-lg py-4 px-8 flex justify-between items-center fixed top-0 z-50">

        
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logorappitec.png') }}" class="w-10 animate-bounce" alt="">
            <span class="text-2xl font-extrabold text-indigo-600 tracking-wide">RAPPITEC</span>
        </div>
        <div>
            @guest
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                   class="ml-2 px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 font-semibold hover:bg-indigo-50 transition">
                    Crear cuenta
                </a>
            @endguest
            @auth
                <a href="{{ auth()->user()->hasRole('seller') ? '/seller/dashboard' : '/catalog' }}"
                   class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                   Ir al dashboard
                </a>
            @endauth
        </div>
    </nav>

<section class="text-center mt-40 px-6">
    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
        Conecta con los negocios del Tec
    </h1>
    <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
        Haz pedidos rápidos, paga en la app y recoge cuando tú quieras.
    </p>
    <p class="mt-3 text-indigo-500 text-xl font-semibold">¡Rápido, confiable y a tu alcance!</p>

    <div class="mt-10 flex justify-center gap-4">
      
        <button onclick="openModal()"
           class="px-6 py-3 bg-indigo-600 text-white rounded-full font-semibold shadow hover:bg-indigo-700 transition">
            Ver cómo funciona
        </button>
    </div>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 max-w-3xl relative shadow-lg animate-fade-in-down">
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            <img src="{{ asset('images/functionament.png') }}" alt="Funcionamiento" class="rounded-lg max-w-full h-auto">
        </div>
    </div>
</section>



    <section id="funciones" class="mt-32 px-6 max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-900">¿Por qué elegir RAPPITEC?</h2>
        <div class="mt-10 grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600">Rápido</h3>
                <p class="text-gray-600 mt-2">Haz tus pedidos en segundos desde cualquier parte del campus.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600">Fácil</h3>
                <p class="text-gray-600 mt-2">Una interfaz simple e intuitiva para que no pierdas tiempo.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600">Confiable</h3>
                <p class="text-gray-600 mt-2">Negocios verificados y soporte en todo momento.</p>
            </div>
        </div>
    </section>


    <script>
        
        document.querySelectorAll('.animate-fade-in-down').forEach((el, i) => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                el.style.transition = 'all 1s ease';
                el.style.opacity = 1;
                el.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
    
<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
</body>
</html>
