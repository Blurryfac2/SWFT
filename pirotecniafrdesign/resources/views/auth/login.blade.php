<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="bg-black text-white font-sans">
    <div class="page-wrapper">
        @include('components.header')

        <main class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-[#1f1f1f] rounded-xl shadow-md p-8 w-full max-w-sm text-center">

                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="mx-auto mb-6 w-32 h-auto">

                <h1 class="text-2xl font-semibold mb-6">Iniciar Sesión</h1>

                <form method="POST" action="{{ route('login') }}" class="text-left">
                    @csrf

                    <label for="email" class="block text-sm font-medium mb-1">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 mb-4 rounded-md border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <label for="password" class="block text-sm font-medium mb-1">Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 mb-4 rounded-md border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @if ($errors->has('email') && $errors->first('email') === __('auth.failed'))
                    <div class="text-red-500 text-sm mb-3">
                        {{ $errors->first('email') }}
                    </div>
                    @endif

                    <div class="text-sm mb-4">
                        <a href="{{ route('password.request') }}" class="text-blue-400 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 transition text-white font-semibold py-2 rounded flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </button>
                </form>
            </div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>
</body>

</html>