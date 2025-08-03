@extends('layouts.admin')

@section('title', 'Productos')

@section('header')
    <h2 class="font-semibold text-xl text-black leading-tight">
    {{ __('Administrar productos') }}
</h2>

@endsection

@section('content')
<div x-data="{ showAdd: false, showEdit: false, editId: null }" class="py-6 px-4 bg-black min-h-screen text-white">

    <button @click="showAdd = true"
        class="bg-yellow-500 hover:bg-yellow-600 transition text-black px-4 py-2 rounded shadow mb-4 font-semibold">
        Agregar producto
    </button>

    @if(session('success'))
        <div class="mb-4 text-green-300 bg-green-900 border border-green-500 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-gray-900 shadow-md rounded border border-gray-700 text-sm">
            <thead class="bg-gray-800 text-yellow-400 uppercase">
                <tr>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Imagen</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-t border-gray-700 hover:bg-gray-800">
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">${{ number_format($product->price, 2) }}</td>
                    <td class="p-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500 italic">Sin imagen</span>
                        @endif
                    </td>
                    <td class="p-3 flex gap-2">
                        <button @click="showEdit = true; editId = {{ $product->id }}"
                            class="text-yellow-400 hover:underline">
                            Editar
                        </button>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este producto?')"
                                class="text-red-400 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Agregar --}}
    <div x-show="showAdd"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50"
        x-cloak>
        <div class="bg-gray-900 p-6 rounded shadow-lg w-full max-w-md relative text-white">
            <button @click="showAdd = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl">✕</button>
            <h3 class="text-lg font-bold mb-4 text-yellow-400">Agregar producto</h3>
            
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block mb-1 text-yellow-400 font-medium">Nombre</label>
                    <input type="text" id="name" name="name" required
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
                
                <div>
                    <label for="price" class="block mb-1 text-yellow-400 font-medium">Precio</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
                
                <div>
                    <label for="description" class="block mb-1 text-yellow-400 font-medium">Descripción</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
                </div>
                
                <div>
                    <label for="image" class="block mb-1 text-yellow-400 font-medium">Imagen</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
                </div>
                
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded transition">
                    Guardar producto
                </button>
            </form>
        </div>
    </div>

    {{-- Modal Editar --}}
    @foreach($products as $product)
    <div x-show="showEdit && editId === {{ $product->id }}"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50"
        x-cloak>
        <div class="bg-gray-900 p-6 rounded shadow-lg w-full max-w-md relative text-white">
            <button @click="showEdit = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl">✕</button>
            <h3 class="text-lg font-bold mb-4 text-yellow-400">Editar producto</h3>
            
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name_{{ $product->id }}" class="block mb-1 text-yellow-400 font-medium">Nombre</label>
                    <input type="text" id="edit_name_{{ $product->id }}" name="name" value="{{ $product->name }}" required
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
                
                <div>
                    <label for="edit_price_{{ $product->id }}" class="block mb-1 text-yellow-400 font-medium">Precio</label>
                    <input type="number" id="edit_price_{{ $product->id }}" name="price" step="0.01" min="0" value="{{ $product->price }}" required
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
                
                <div>
                    <label for="edit_description_{{ $product->id }}" class="block mb-1 text-yellow-400 font-medium">Descripción</label>
                    <textarea id="edit_description_{{ $product->id }}" name="description" rows="3"
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">{{ $product->description }}</textarea>
                </div>
                
                <div>
                    <label for="edit_image_{{ $product->id }}" class="block mb-1 text-yellow-400 font-medium">Imagen</label>
                    <input type="file" id="edit_image_{{ $product->id }}" name="image" accept="image/*"
                        class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
                    @if($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded">
                        </div>
                    @endif
                </div>
                
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded transition">
                    Actualizar producto
                </button>
            </form>
        </div>
    </div>
    @endforeach

</div>

<style>
    /* Estilos para inputs en modales */
    [x-cloak] .bg-gray-900 input[type="text"],
    [x-cloak] .bg-gray-900 input[type="number"],
    [x-cloak] .bg-gray-900 input[type="file"],
    [x-cloak] .bg-gray-900 textarea,
    [x-cloak] .bg-gray-900 select {
        background-color: #1f2937 !important;
        color: #fff !important;
        border: 1px solid #d97706 !important;
        border-radius: 0.375rem !important;
        padding: 0.5rem 0.75rem !important;
        width: 100% !important;
        margin-bottom: 0.5rem !important;
        transition: all 0.2s;
    }

    [x-cloak] .bg-gray-900 input::placeholder,
    [x-cloak] .bg-gray-900 textarea::placeholder {
        color: #9ca3af !important;
    }

    [x-cloak] .bg-gray-900 input:focus,
    [x-cloak] .bg-gray-900 textarea:focus,
    [x-cloak] .bg-gray-900 select:focus {
        outline: none !important;
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2) !important;
    }

    [x-cloak] .bg-gray-900 label {
        color: #fbbf24 !important;
        font-weight: 500 !important;
        display: block !important;
        margin-bottom: 0.25rem !important;
        font-size: 0.875rem !important;
    }

    /* Estilo para el input file */
    [x-cloak] .bg-gray-900 input[type="file"]::file-selector-button {
        background-color: #d97706;
        color: #000;
        border: 0;
        padding: 0.5rem 1rem;
        margin-right: 1rem;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    [x-cloak] .bg-gray-900 input[type="file"]::file-selector-button:hover {
        background-color: #b45309;
    }
</style>
@endsection