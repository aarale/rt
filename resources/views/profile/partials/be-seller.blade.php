<section class="rounded-xl transition  max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">¿Tienes un negocio en el Tec?</h2>

    <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
        Únete como vendedor y ofrece tus productos directamente desde la plataforma.
    </p>

    @auth
        @if(auth()->user()->hasRole('customer'))
        
            <a href="{{ route('seller.business.create') }}" class="inline-block px-8 py-3 bg-green-600 text-white rounded-full font-semibold shadow hover:bg-green-700 transition">
    Registrar mi negocio
</a>

        @else
            <p class="text-green-600 font-semibold">Ya estás registrado como vendedor.</p>
        @endif
    @else
        <form action="{{ route('seller.business.create') }}" method="GET">
            <button type="submit"
                    class="px-8 py-3 bg-green-600 text-white rounded-full font-semibold shadow hover:bg-green-700 transition">
                Regístrate como vendedor
            </button>
        </form>
    @endauth
</section>