<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Mostrar lista de productos
     */
    public function index()
    {
        $productos = Producto::activos()->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Mostrar formulario para crear producto
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean'
        ]);

        $data = $request->all();

        // Manejar subida de imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('productos', $nombreImagen, 'public');
            $data['imagen'] = $rutaImagen;
        }

        Producto::create($data);

        return redirect()->route('productos.index')
                        ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar producto específico
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Mostrar formulario para editar producto
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean'
        ]);

        $data = $request->all();

        // Manejar subida de nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('productos', $nombreImagen, 'public');
            $data['imagen'] = $rutaImagen;
        }

        $producto->update($data);

        return redirect()->route('productos.index')
                        ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Producto $producto)
    {
        // Eliminar imagen si existe
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')
                        ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Cambiar estado activo/inactivo del producto
     */
    public function toggleStatus(Producto $producto)
    {
        $producto->activo = !$producto->activo;
        $producto->save();

        $estado = $producto->activo ? 'activado' : 'desactivado';

        return redirect()->route('productos.index')
                        ->with('success', "Producto {$estado} exitosamente.");
    }

    /**
     * Actualizar stock del producto
     */
    public function updateStock(Request $request, Producto $producto)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'accion' => 'required|in:agregar,quitar,establecer'
        ]);

        $nuevoStock = $request->stock;
        $accion = $request->accion;

        switch ($accion) {
            case 'agregar':
                $producto->aumentarStock($nuevoStock);
                $mensaje = "Se agregaron {$nuevoStock} unidades al stock.";
                break;

            case 'quitar':
                if ($producto->tieneStock($nuevoStock)) {
                    $producto->reducirStock($nuevoStock);
                    $mensaje = "Se quitaron {$nuevoStock} unidades del stock.";
                } else {
                    return redirect()->back()
                                   ->with('error', 'No hay suficiente stock para quitar esa cantidad.');
                }
                break;

            case 'establecer':
                $producto->stock = $nuevoStock;
                $producto->save();
                $mensaje = "Stock establecido a {$nuevoStock} unidades.";
                break;
        }

        return redirect()->route('productos.show', $producto)
                        ->with('success', $mensaje);
    }

    /**
     * API: Obtener todos los productos
     */
    public function apiIndex()
    {
        $productos = Producto::activos()->get();
        return response()->json($productos);
    }

    /**
     * API: Obtener producto por ID
     */
    public function apiShow($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    /**
     * API: Crear producto
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    /**
     * API: Actualizar producto
     */
    public function apiUpdate(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $producto->update($request->all());

        return response()->json($producto);
    }

    /**
     * API: Eliminar producto
     */
    public function apiDestroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}
