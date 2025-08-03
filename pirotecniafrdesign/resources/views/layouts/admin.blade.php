<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- Agrega esto para responsividad --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Admin')</title>
    <style>[x-cloak] { display: none !important; }</style>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">

    {{-- Navegación principal --}}
    @include('layouts.navigation')

    {{-- Encabezado responsivo --}}
    <header class="bg-black  shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('header')
        </div>
    </header>

    {{-- Contenido principal --}}
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </div>
    </main>

</body>
</html>
