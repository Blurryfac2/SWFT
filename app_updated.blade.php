<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pirotecnia') - Sistema de Gestión</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        .btn {
            border-radius: 0.375rem;
        }
        .table th {
            border-top: none;
            font-weight: 600;
        }
        .badge {
            font-size: 0.75em;
        }
        .img-thumbnail {
            border-radius: 0.375rem;
        }
        .alert {
            border-radius: 0.5rem;
        }
        footer {
            margin-top: auto;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .rol-badge {
            font-size: 0.7em;
            padding: 0.25em 0.5em;
        }
        .user-info {
            font-size: 0.9em;
        }
        .critical-action {
            border: 2px solid #dc3545;
            background-color: #fff5f5;
        }
        .test-section {
            background-color: #e7f3ff;
            border-left: 4px solid #0066cc;
            padding: 1rem;
            margin: 1rem 0;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ auth()->check() ? route('productos.index') : '/' }}">
                <i class="fas fa-fire"></i> Pirotecnia
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" 
                               href="{{ route('productos.index') }}">
                                <i class="fas fa-box"></i> Productos
                            </a>
                        </li>

                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('productos.create') }}">
                                    <i class="fas fa-plus"></i> Agregar Producto
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i> Registrarse
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-info" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> 
                                {{ Auth::user()->name }}
                                <span class="badge bg-{{ Auth::user()->rol_color }} rol-badge">
                                    {{ Auth::user()->rol_formateado }}
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->isTest())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('descargar.logs') }}">
                                            <i class="fas fa-download text-info"></i> Descargar Logs
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif

                                @if(Auth::user()->isAdminFull())
                                    <li>
                                        <h6 class="dropdown-header text-danger">
                                            <i class="fas fa-exclamation-triangle"></i> Acciones Críticas
                                        </h6>
                                    </li>
                                    <li>
                                        <form action="{{ route('limpiar.logs') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-warning"
                                                    onclick="return confirm('¿Estás seguro de limpiar todos los logs?')">
                                                <i class="fas fa-broom"></i> Limpiar Logs
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('productos.destroy-all') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('¿ESTÁS SEGURO? Esta acción eliminará TODOS los productos y NO se puede deshacer.')">
                                                <i class="fas fa-trash-alt"></i> Eliminar Todos los Productos
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif

                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configuración</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Información del rol del usuario -->
    @auth
        @if(Auth::user()->isTest())
            <div class="test-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="mb-0">
                                <i class="fas fa-flask"></i> Modo de Prueba Activo
                            </h6>
                            <small class="text-muted">
                                Todas tus acciones están siendo registradas en los logs del sistema.
                            </small>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('descargar.logs') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-download"></i> Descargar Logs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        <i class="fas fa-fire"></i> Sistema de Gestión de Pirotecnia
                    </p>
                    @auth
                        <small class="text-muted">
                            Conectado como: {{ Auth::user()->rol_formateado }}
                        </small>
                    @endauth
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted">
                        © {{ date('Y') }} - Desarrollado con Laravel
                    </p>
                    <small class="text-muted">
                        Versión 2.0 con Sistema de Roles
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Confirm delete actions
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('form[onsubmit*="confirm"] button[type="submit"]');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    if (!confirm('¿Estás seguro de realizar esta acción?')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Highlight critical actions
        document.addEventListener('DOMContentLoaded', function() {
            const criticalButtons = document.querySelectorAll('.text-danger, .btn-danger');
            criticalButtons.forEach(function(button) {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                    this.style.transition = 'transform 0.2s';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
