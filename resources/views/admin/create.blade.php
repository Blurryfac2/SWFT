<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="name" class="w-full border mb-2 px-2 py-1" placeholder="Nombre" required>
    <textarea name="description" class="w-full border mb-2 px-2 py-1" placeholder="Descripción"></textarea>
    <input name="price" type="number" step="0.01" class="w-full border mb-2 px-2 py-1" placeholder="Precio" required>
    <input name="image" type="file" class="w-full mb-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
