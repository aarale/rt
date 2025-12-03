<x-guest-layout>
    <div class="min-h-screen flex">
       
<div class="hidden lg:flex w-1/2 bg-sky-600 justify-center items-center text-white p-10">
            <div class="text-center space-y-1">
                <a href="/"> <img src="{{ asset('images/logorappitec.png') }}" alt="Rappitec" class="w-50% h-50% ">
</a>

            </div>
        </div>


        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center px-6 py-12">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md space-y-1">
                @csrf
                <h2 class="text-3xl font-bold text-center text-gray-800">Crea tu cuenta</h2>

                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-label for="lastname" :value="__('Apellido')" />
                <x-text-input id="lastname" class="w-full" type="text" name="lastname" :value="old('lastname')" required />

                <x-input-label for="bdate" :value="__('Fecha de nacimiento')" />
                <x-text-input id="bdate" class="w-full" type="date" name="bdate" :value="old('bdate')" required />

                <x-input-label for="ncontrol" :value="__('Número de control')" />
                <x-text-input id="ncontrol" class="w-full" type="text" name="ncontrol" :value="old('ncontrol')" required />

                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required />

                <x-input-label for="phone" :value="__('Teléfono')" />
                <x-text-input id="phone" class="w-full" type="text" name="phone" :value="old('phone')" required />

                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="w-full" type="password" name="password" required />

                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                <x-text-input id="password_confirmation" class="w-full" type="password" name="password_confirmation" required />

               <div class="flex items-center gap-2">
                <input type="checkbox" id="my-checkbox" class="appearance-none w-4 h-4 border-2 border-gray-400 rounded-sm checked:bg-blue-500 checked:border-blue-500" />
            <label for="my-checkbox" class="text-gray-700"><a href="{{ route('aviso') }}">Aviso de privacidad</a></label>
             </div>


                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:underline">¿Ya tienes cuenta?</a>
                    <x-primary-button class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                        {{ __('Regístrate') }}
                    </x-primary-button>
                </div>

                <div class="mt-6">
                    <div class="flex flex-col gap-3">
                        <button class="flex items-center justify-center gap-3 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                            <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" class="w-5 h-5"> Continuar con Google
                        </button>
                        <button class="flex items-center justify-center gap-3 bg-black text-white py-2 rounded hover:bg-gray-800">
                             Continuar con Apple
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
