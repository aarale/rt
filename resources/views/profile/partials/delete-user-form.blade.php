<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Eliminar cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una vez eliminada tu cuenta, no podrás recuperarla.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <div>
            <label class="block font-medium text-sm text-gray-700">Contraseña</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
        </div>

        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Eliminar cuenta
        </button>
    </form>
</section>
