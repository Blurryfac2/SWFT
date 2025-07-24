@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $producto->nombre }}</h4>
                        <div>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
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

                    <div class="row">
                        <div class="col-md-4">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                     alt="{{ $producto->nombre }}" 
                                     class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                     style="height: 250px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $producto->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td>{{ $producto->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Precio:</th>
                                    <td class="h5 text-success">{{ $producto->precio_formateado }}</td>
                                </tr>
                                <tr>
                                    <th>Stock:</th>
                                    <td>
                                        <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                            {{ $producto->stock }} unidades
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Categoría:</th>
                                    <td>{{ $producto->categoria ?? 'Sin categoría' }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        <span class="badge {{ $producto->activo ? 'bg-success' : 'bg-secondary' }} fs-6">
                                            {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creado:</th>
                                    <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Actualizado:</th>
                                    <td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($producto->descripcion)
                        <div class="mt-4">
                            <h5>Descripción</h5>
                            <p class="text-muted">{{ $producto->descripcion }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Card para gestionar stock -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-boxes"></i> Gestión de Stock</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('productos.update-stock', $producto) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="stock" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="accion" class="form-label">Acción</label>
                            <select class="form-select" id="accion" name="accion" required>
                                <option value="">Seleccionar acción</option>
                                <option value="agregar">Agregar al stock</option>
                                <option value="quitar">Quitar del stock</option>
                                <option value="establecer">Establecer stock</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync-alt"></i> Actualizar Stock
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card para acciones rápidas -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs"></i> Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('productos.toggle-status', $producto) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $producto->activo ? 'btn-warning' : 'btn-success' }} w-100">
                                <i class="fas {{ $producto->activo ? 'fa-pause' : 'fa-play' }}"></i>
                                {{ $producto->activo ? 'Desactivar' : 'Activar' }} Producto
                            </button>
                        </form>

                        <form action="{{ route('productos.destroy', $producto) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Eliminar Producto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
