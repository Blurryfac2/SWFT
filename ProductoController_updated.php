<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol:test,admin_base,admin_full')->only(['index', 'show']);
        $this->middleware('rol:admin_base,admin_full')->only(['create', 'store', 'edit', 'update', 'destroy', 'toggleStatus', 'updateStock']);
        $this->middleware('rol:admin_full')->only(['destroyAll', 'restoreBackup']);
    }

    /**
     * Mostrar lista de productos
     */
    public function index()
    {
        $productos = Producto::activos()->paginate(10);

        // Log para usuarios test
        if (Auth::user()->isTest()) {
            Log::info('Usuario test accedió a la lista de productos', [
                'usuario' => Auth::user()->name,
                'email' => Auth::user()->email,
                'timestamp' => now()
            ]);
        }

        return view('productos.index', compact('productos'));
    }

    /**
     * Mostrar formulario para crear producto
     */
    public function create()
    {
        Log::info('Acceso al formulario de creación de producto', [
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

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

        $producto = Producto::create($data);

        // Log de creación
        Log::info('Producto creado', [
            'producto_id' => $producto->id,
            'nombre' => $producto->nombre,
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

        return redirect()->route('productos.index')
                        ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar producto específico
     */
    public function show(Producto $producto)
    {
        // Log para usuarios test
        if (Auth::user()->isTest()) {
            Log::info('Usuario test visualizó producto', [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'usuario' => Auth::user()->name
            ]);
        }

        return view('productos.show', compact('producto'));
    }

    /**
     * Mostrar formulario para editar producto
     */
    public function edit(Producto $producto)
    {
        Log::info('Acceso al formulario de edición', [
            'producto_id' => $producto->id,
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

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
        $datosAnteriores = $producto->toArray();

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

        // Log de actualización
        Log::info('Producto actualizado', [
            'producto_id' => $producto->id,
            'datos_anteriores' => $datosAnteriores,
            'datos_nuevos' => $producto->fresh()->toArray(),
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

        return redirect()->route('productos.index')
                        ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Producto $producto)
    {
        $datosProducto = $producto->toArray();

        // Eliminar imagen si existe
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        // Log de eliminación
        Log::warning('Producto eliminado', [
            'producto_eliminado' => $datosProducto,
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

        return redirect()->route('productos.index')
                        ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Cambiar estado activo/inactivo del producto
     */
    public function toggleStatus(Producto $producto)
    {
        $estadoAnterior = $producto->activo;
        $producto->activo = !$producto->activo;
        $producto->save();

        $estado = $producto->activo ? 'activado' : 'desactivado';

        // Log de cambio de estado
        Log::info('Estado de producto cambiado', [
            'producto_id' => $producto->id,
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo' => $producto->activo,
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

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

        $stockAnterior = $producto->stock;
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

        // Log de cambio de stock
        Log::info('Stock actualizado', [
            'producto_id' => $producto->id,
            'stock_anterior' => $stockAnterior,
            'stock_nuevo' => $producto->fresh()->stock,
            'accion' => $accion,
            'cantidad' => $nuevoStock,
            'usuario' => Auth::user()->name,
            'rol' => Auth::user()->rol
        ]);

        return redirect()->route('productos.show', $producto)
                        ->with('success', $mensaje);
    }

    /**
     * Descargar logs (solo para usuarios test)
     */
    public function descargarLogs()
    {
        if (!Auth::user()->isTest()) {
            abort(403, 'Solo usuarios de prueba pueden descargar logs.');
        }

        $logPath = storage_path('logs/laravel.log');

        if (!file_exists($logPath)) {
            return redirect()->back()->with('error', 'No existen logs para descargar.');
        }

        // Log de descarga de logs
        Log::info('Logs descargados por usuario test', [
            'usuario' => Auth::user()->name,
            'email' => Auth::user()->email,
            'timestamp' => now()
        ]);

        return response()->download($logPath, 'sistema_logs_' . date('Y-m-d_H-i-s') . '.txt');
    }

    /**
     * Limpiar logs (solo para admin_full)
     */
    public function limpiarLogs()
    {
        if (!Auth::user()->isAdminFull()) {
            abort(403, 'Solo administradores full pueden limpiar logs.');
        }

        $logPath = storage_path('logs/laravel.log');

        if (file_exists($logPath)) {
            file_put_contents($logPath, '');
            Log::warning('Logs limpiados por administrador', [
                'usuario' => Auth::user()->name,
                'timestamp' => now()
            ]);
            return redirect()->back()->with('success', 'Logs limpiados exitosamente.');
        }

        return redirect()->back()->with('error', 'No se encontraron logs para limpiar.');
    }

    /**
     * Eliminar todos los productos (solo admin_full)
     */
    public function destroyAll()
    {
        if (!Auth::user()->isAdminFull()) {
            abort(403, 'Solo administradores full pueden realizar esta acción.');
        }

        $cantidadProductos = Producto::count();
        Producto::truncate();

        Log::critical('Todos los productos fueron eliminados', [
            'cantidad_eliminada' => $cantidadProductos,
            'usuario' => Auth::user()->name,
            'timestamp' => now()
        ]);

        return redirect()->route('productos.index')
                        ->with('success', "Se eliminaron {$cantidadProductos} productos exitosamente.");
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
