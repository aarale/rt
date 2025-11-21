<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>
@if(auth()->user()->is_seller)
    <!-- Está en modo vendedor -->
    <form action="{{ route('profile.switch.to.customer') }}" method="POST">
        @csrf
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Cambiar a modo Cliente
        </button>
    </form>
@else
    <!-- Está en modo cliente -->
    <form action="{{ route('profile.becomeSeller') }}" method="POST">
        @csrf
        <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Cambiar a modo Vendedor
        </button>
    </form>
@endif


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
            
            {{-- Eliminar cuenta --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
