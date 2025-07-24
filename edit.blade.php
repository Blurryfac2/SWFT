@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Editar Producto: {{ $producto->nombre }}</h4>
                        <div>
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                                    <input type="text" 
                                           class="form-control @error('nombre') is-invalid @enderror" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="{{ old('nombre', $producto->nombre) }}" 
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <input type="text" 
                                           class="form-control @error('categoria') is-invalid @enderror" 
                                           id="categoria" 
                                           name="categoria" 
                                           value="{{ old('categoria', $producto->categoria) }}">
                                    @error('categoria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               class="form-control @error('precio') is-invalid @enderror" 
                                               id="precio" 
                                               name="precio" 
                                               value="{{ old('precio', $producto->precio) }}" 
                                               step="0.01" 
                                               min="0" 
                                               required>
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock *</label>
                                    <input type="number" 
                                           class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" 
                                           name="stock" 
                                           value="{{ old('stock', $producto->stock) }}" 
                                           min="0" 
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del Producto</label>

                            @if($producto->imagen)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 150px; max-height: 150px;">
                                    <p class="text-muted small mt-1">Imagen actual</p>
                                </div>
                            @endif

                            <input type="file" 
                                   class="form-control @error('imagen') is-invalid @enderror" 
                                   id="imagen" 
                                   name="imagen" 
                                   accept="image/*">
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB
                                @if($producto->imagen)
                                    <br><strong>Nota:</strong> Si seleccionas una nueva imagen, reemplazará la actual.
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="activo" 
                                       name="activo" 
                                       value="1" 
                                       {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">
                                    Producto activo
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-secondary me-md-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Preview de imagen
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Crear preview si no existe
            let preview = document.getElementById('imagen-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'imagen-preview';
                preview.className = 'img-thumbnail mt-2';
                preview.style.maxWidth = '200px';
                preview.style.maxHeight = '200px';

                // Crear contenedor para el preview
                const previewContainer = document.createElement('div');
                previewContainer.className = 'mt-2';
                previewContainer.appendChild(preview);

                const previewLabel = document.createElement('p');
                previewLabel.className = 'text-muted small mt-1 mb-0';
                previewLabel.textContent = 'Nueva imagen seleccionada';
                previewContainer.appendChild(previewLabel);

                document.getElementById('imagen').parentNode.appendChild(previewContainer);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
