<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pirotecnia FR')</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sesion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atractivos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/historia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/56497fa989.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/TU_CODIGO_KIT.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/TU_CODIGO_KIT.js" crossorigin="anonymous"></script>


</head>
<body>
    
    <!-- Encabezado -->
    <header>
        <div id="header">
            <img src="{{ asset('img/PERFIL.jpg') }}" alt="Logo izquierdo">
            <h1>PIROTECNIA "FR"</h1>
            <img src="{{ asset('img/PERFIL.jpg') }}" alt="Logo derecho">
        </div>
    </header>

    <!-- Navegación -->
    <nav class="menu">
        <ul>
            <li><a href="{{ route('inicio') }}">Inicio</a></li>
            <li><a href="{{ route('productos') }}">Productos</a></li>
            <li><a href="{{ route('historia') }}">Historia</a></li>
            <li><a href="{{ route('contacto') }}">Contacto</a></li>
            <li><a href="{{ route('sesion') }}">Iniciar sesión</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    <!-- Botón de Facebook -->
    <div id="facebook">
        <a href="https://www.facebook.com/share/15WuC76jMQ/" target="_blank">
            <i class="fa-brands fa-facebook"></i>
        </a>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Pirotecnia FR</p>
    </footer>

  <!-- Botón flotante de WhatsApp (imagen personalizada) -->
<a href="https://wa.me/5217711234567" class="whatsapp-img" target="_blank" title="Contáctanos por WhatsApp">
    <img src="{{ asset('img/whatsapp-icon.png') }}" alt="WhatsApp">
</a>

    <!-- Scripts -->
    <script src="{{ asset('js/slide.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
