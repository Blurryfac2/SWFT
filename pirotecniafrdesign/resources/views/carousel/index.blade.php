@extends('layouts.admin')

@section('title', 'Carrusel')

@section('header')
<h2 class="font-semibold text-xl text-black leading-tight">
    {{ __('Administrar carrusel') }}
</h2>
@endsection

@section('content')
<div x-data="{ showAdd: false, showEdit: false, editId: null }" class="py-6 px-4 bg-black min-h-screen text-white">

    <button @click="showAdd = true"
        class="bg-yellow-500 hover:bg-yellow-600 transition text-black px-4 py-2 rounded shadow mb-4 font-semibold">
        Agregar imagen
    </button>

    @if(session('success'))
        <div class="mb-4 text-green-300 bg-green-900 border border-green-500 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($images as $image)
        <div class="bg-gray-900 p-4 rounded shadow-md border border-gray-700">
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}"
                class="w-full h-48 object-cover rounded mb-3">
            <h3 class="text-yellow-400 font-semibold text-lg mb-2">{{ $image->title }}</h3>
            <div class="flex justify-between">
                <button @click="showEdit = true; editId = {{ $image->id }}"
                    class="text-yellow-400 hover:underline">Editar</button>
                <form action="{{ route('carousel.destroy', $image) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar esta imagen?')">
                    @csrf @method('DELETE')
                    <button class="text-red-400 hover:underline">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Modal Agregar --}}
    <div x-show="showAdd"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50"
        x-cloak>
        <div class="bg-gray-900 p-6 rounded shadow-lg w-full max-w-md relative text-white">
            <button @click="showAdd = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl">✕</button>
            <h3 class="text-lg font-bold mb-4 text-yellow-400">Agregar imagen</h3>
            @include('carousel.create')
        </div>
    </div>

    {{-- Modal Editar --}}
    @foreach($images as $image)
    <div x-show="showEdit && editId === {{ $image->id }}"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50"
        x-cloak>
        <div class="bg-gray-900 p-6 rounded shadow-lg w-full max-w-md relative text-white">
            <button @click="showEdit = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl">✕</button>
            <h3 class="text-lg font-bold mb-4 text-yellow-400">Editar imagen</h3>
            @include('carousel.edit', ['carousel' => $image])
        </div>
    </div>
    @endforeach

</div>

<style>
    [x-cloak] .bg-gray-900 input[type="text"],
    [x-cloak] .bg-gray-900 input[type="file"],
    [x-cloak] .bg-gray-900 textarea {
        background-color: #1f2937 !important;
        color: #fff !important;
        border: 1px solid #d97706 !important;
        border-radius: 0.375rem !important;
        padding: 0.5rem 0.75rem !important;
        width: 100% !important;
        margin-bottom: 0.5rem !important;
    }

    [x-cloak] .bg-gray-900 input::placeholder,
    [x-cloak] .bg-gray-900 textarea::placeholder {
        color: #9ca3af !important;
    }

    [x-cloak] .bg-gray-900 input:focus,
    [x-cloak] .bg-gray-900 textarea:focus {
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
