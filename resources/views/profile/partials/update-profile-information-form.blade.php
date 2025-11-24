<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualiza la información de tu perfil y tu dirección de correo.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-sm text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Apellido</label>
                <input type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Correo</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                Guardar
            </button>
        </div>
    </form>
</section>

