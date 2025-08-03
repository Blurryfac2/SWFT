<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white">
    <div class="page-wrapper">
        @include('components.header')

       
        <main class="p-6 pt-40">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div
                        class="bg-zinc-900 rounded-xl p-4 shadow-lg flex flex-col items-center
                               transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-60 object-cover rounded mb-2">
                        @endif

                        <h2 class="text-lg font-semibold mb-2 text-center">{{ strtoupper($product->name) }}</h2>

                        @if($product->description)
                            <p class="text-sm text-gray-300 text-center">{{ $product->description }}</p>
                        @endif

                        @if($product->price)
                            <p class="text-white font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-400 col-span-full text-center">No hay productos disponibles.</p>
                @endforelse
            </div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>
</body>

</html>
