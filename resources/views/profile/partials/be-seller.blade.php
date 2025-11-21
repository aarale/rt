<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Quiero registrar mi negocio') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Quiero ser vendedor de RappiTec.') }}
        </p>
    </header>

      {{-- Botón Convertirme en vendedor --}}
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                ¿Quieres ser vendedor?
            </label>

            @if (!auth()->user()->hasRole('seller'))
    <form action="{{ route('profile.becomeSeller') }}" method="POST">

        @csrf
        <x-primary-button>Convertirme en Vendedor</x-primary-button>
    </form>
@else
    <div class="text-green-600 font-semibold">Ya eres vendedor</div>
@endif

        </div>
        @if(auth()->user()->hasRole('seller') && auth()->user()->hasRole('customer'))

    @if(session('mode') !== 'customer')
        <form action="{{ route('profile.switch.to.customer') }}" method="POST">
            @csrf
            <x-primary-button class="mt-4">Cambiar a modo cliente</x-primary-button>
        </form>
    @else
        <div class="text-green-600 mt-4">Estás navegando como cliente</div>
    @endif

@endif

</section>
