@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Productos</h1>
                <div>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('productos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </a>
                    @endif

                    @if(Auth::user()->isTest())
                        <a href="{{ route('descargar.logs') }}" class="btn btn-outline-info">
                            <i class="fas fa-download"></i> Descargar Logs
                        </a>
                    @endif
                </div>
            </div>

            <!-- Información del rol actual -->
            <div class="alert alert-{{ Auth::user()->rol_color }} alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i>
                <strong>Rol actual:</strong> {{ Auth::user()->rol_formateado }}
                @if(Auth::user()->isTest())
                    - Puedes ver productos y descargar logs de prueba.
                @elseif(Auth::user()->isAdminBase())
                    - Puedes crear, editar y eliminar productos.
                @elseif(Auth::user()->isAdminFull())
                    - Tienes acceso completo incluyendo acciones críticas.
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Acciones críticas para admin_full -->
            @if(Auth::user()->isAdminFull())
                <div class="card critical-action mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle"></i> Zona de Acciones Críticas
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-danger mb-3">
                            <strong>¡ATENCIÓN!</strong> Las siguientes acciones son irreversibles y pueden afectar todo el sistema.
                        </p>
                        <div class="d-flex gap-2">
                            <form action="{{ route('productos.destroy-all') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿ESTÁS COMPLETAMENTE SEGURO? Esta acción eliminará TODOS los productos y NO se puede deshacer. Escribe ELIMINAR TODO para confirmar.') && prompt('Escribe ELIMINAR TODO para confirmar:') === 'ELIMINAR TODO'">
                                    <i class="fas fa-trash-alt"></i> Eliminar Todos los Productos
                                </button>
                            </form>

                            <form action="{{ route('limpiar.logs') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning"
                                        onclick="return confirm('¿Estás seguro de limpiar todos los logs del sistema?')">
                                    <i class="fas fa-broom"></i> Limpiar Logs del Sistema
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if($productos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>
                                                @if($producto->imagen)
                                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                                         alt="{{ $producto->nombre }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->precio_formateado }}</td>
                                            <td>
                                                <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $producto->stock }}
                                                </span>
                                            </td>
                                            <td>{{ $producto->categoria ?? 'Sin categoría' }}</td>
                                            <td>
                                                <span class="badge {{ $producto->activo ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Ver (todos los roles) -->
                                                    <a href="{{ route('productos.show', $producto) }}" 
                                                       class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <!-- Editar (solo admins) -->
                                                    @if(Auth::user()->isAdmin())
                                                        <a href="{{ route('productos.edit', $producto) }}" 
                                                           class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <!-- Toggle status (solo admins) -->
                                                        <form action="{{ route('productos.toggle-status', $producto) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    class="btn btn-sm {{ $producto->activo ? 'btn-secondary' : 'btn-success' }}">
                                                                <i class="fas {{ $producto->activo ? 'fa-pause' : 'fa-play' }}"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Eliminar (solo admins) -->
                                                        <form action="{{ route('productos.destroy', $producto) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="d-flex justify-content-center">
                            {{ $productos->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h4>No hay productos registrados</h4>
                            <p class="text-muted">
                                @if(Auth::user()->isAdmin())
                                    Comienza agregando tu primer producto.
                                @else
                                    No tienes permisos para agregar productos.
                                @endif
                            </p>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Agregar Producto
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
