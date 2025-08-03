<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">
            <h2 class="text-xl font-bold text-center text-blue-700 mb-4">Establecer nueva contraseña</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email"
                    value="{{ old('email', $request->email) }}" required autofocus
                    class="mt-1 block w-full px-4 py-2 border rounded border-gray-300 focus:outline-none focus:ring focus:border-blue-400 mb-3">
                @error('email')
                    <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                @enderror

                <label for="password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border rounded border-gray-300 focus:outline-none focus:ring focus:border-blue-400 mb-3">
                @error('password')
                    <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                @enderror

                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full px-4 py-2 border rounded border-gray-300 focus:outline-none focus:ring focus:border-blue-400 mb-4">
                @error('password_confirmation')
                    <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                @enderror

                <button type="submit"
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Guardar nueva contraseña
                </button>
            </form>
        </div>
    </div>
</body>
</html>
