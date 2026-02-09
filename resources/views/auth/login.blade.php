<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold heading-font gradient-text mb-2">Bienvenido de vuelta</h2>
        <p class="text-gray-400 text-sm">Accede al panel de administración</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-amber-400 mb-2">
                <i class="fas fa-envelope mr-2"></i>Email
            </label>
            <input id="email" 
                   class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-500 focus:outline-none" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="tu@email.com" />
            @error('email')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-amber-400 mb-2">
                <i class="fas fa-lock mr-2"></i>Contraseña
            </label>
            <div class="relative">
                <input id="password" 
                       class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-500 focus:outline-none" 
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password"
                       placeholder="••••••••" />
                <button type="button" 
                        onclick="togglePassword()" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-400 transition">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" 
                       type="checkbox" 
                       class="w-4 h-4 rounded border-amber-500 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900 bg-slate-700 cursor-pointer" 
                       name="remember">
                <span class="ml-2 text-sm text-gray-300 group-hover:text-amber-400 transition">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-amber-400 hover:text-amber-300 transition font-medium" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="btn-primary w-full py-3 px-4 rounded-xl font-bold text-lg shadow-lg relative z-10 uppercase tracking-wider">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Iniciar Sesión
                </span>
            </button>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
