<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Cambiar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asegúrate de usar una contraseña segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block font-medium text-sm text-gray-700">Contraseña actual</label>
            <input type="password" name="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Nueva contraseña</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
        </div>

        <button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
            Actualizar contraseña
        </button>
    </form>
</section>
