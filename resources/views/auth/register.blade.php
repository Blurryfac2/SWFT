<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <h1>Crear cuenta</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email">Correo electrónic0o</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit" style="margin-left: 1rem;">Registrarse</button>
        </div>
    </form>
</body>

</html>