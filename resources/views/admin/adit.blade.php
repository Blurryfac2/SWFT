<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <input name="name" value="{{ $product->name }}" class="w-full border mb-2 px-2 py-1" required>
    <textarea name="description" class="w-full border mb-2 px-2 py-1">{{ $product->description }}</textarea>
    <input name="price" type="number" step="0.01" value="{{ $product->price }}" class="w-full border mb-2 px-2 py-1" required>
    <input name="image" type="file" class="w-full mb-4">
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="w-24 mb-2">
    @endif
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
</form>
