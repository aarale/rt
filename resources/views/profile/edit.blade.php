<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

          

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Actualizar información de perfil --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Cambiar contraseña --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            {{-- Convertirme en vendedor --}}
            <div class="relative hover:shadow-lg transition rounded-lg overflow-hidden group">
    <a href="{{ route('seller.business.create') }}" class="absolute inset-0 z-10"></a>

    <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg relative z-20">
        <div class="max-w-xl">
            @include('profile.partials.be-seller')
        </div>
    </div>
</div>

            {{-- Eliminar cuenta --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
