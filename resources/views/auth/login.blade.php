<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- IZQUIERDA: Branding -->
        <div class="hidden lg:flex w-1/2 bg-sky-600 justify-center items-center text-white p-10">
            <div class="text-center space-y-1">
                <a href="/"> <img src="{{ asset('images/logorappitec.png') }}" alt="Rappitec" class="w-50% h-50% ">
</a>

            </div>
        </div>

        <!-- DERECHA: Formulario de login -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center px-6 py-12">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md space-y-6">
                @csrf

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <h2 class="text-3xl font-bold text-center text-gray-800">Inicia sesión</h2>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Correo')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="relative">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                    <button type="button" onclick="togglePassword()" class="absolute right-2 top-9 text-gray-500 hover:text-gray-700">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Recordarme -->
                <div class="block">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-500 shadow-sm focus:ring-orange-400" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Recordarme la próxima vez</span>
                    </label>
                </div>

                <!-- Links -->
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <a href="{{ route('register') }}" class="text-sky-500 hover:underline">
                        ¿No tienes cuenta? Regístrate
                    </a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Botón de login -->
                <div class="flex justify-end mt-4">
                    <x-primary-button class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                        {{ __('Inicia Sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.96 9.96 0 012.442-3.993M9.88 9.88a3 3 0 104.24 4.24M15 12a3 3 0 01-3 3m-1.88-1.88L4.22 4.22m15.56 15.56L4.22 4.22" />
                `;
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</x-guest-layout>
