<form action="{{ route('carousel.update', ['carousel' => $carousel->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="title" class="block mb-1 text-yellow-400 font-medium">Título</label>
        <input name="title" id="title" type="text" value="{{ $carousel->title }}" required
            class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
    </div>

    <div>
        <label for="image" class="block mb-1 text-yellow-400 font-medium">Imagen (opcional)</label>
        <input name="image" id="image" type="file" accept="image/*"
            class="w-full bg-gray-800 border border-yellow-500 rounded px-3 py-2 text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
        <p class="text-sm text-gray-400 mt-1">Dejar en blanco si no deseas cambiar la imagen.</p>
        @if($carousel->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $carousel->image_path) }}" class="w-20 h-20 object-cover rounded">
            </div>
        @endif
    </div>

    <button type="submit"
        class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded transition">
        Actualizar imagen
    </button>
</form>
