<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria',
        'imagen',
        'activo'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    // Scope para productos activos
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Scope para productos con stock
    public function scopeConStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Accessor para formatear el precio
    public function getPrecioFormateadoAttribute()
    {
        return '$' . number_format($this->precio, 2);
    }

    // Verificar si el producto tiene stock
    public function tieneStock($cantidad = 1)
    {
        return $this->stock >= $cantidad;
    }

    // Reducir stock
    public function reducirStock($cantidad)
    {
        if ($this->tieneStock($cantidad)) {
            $this->stock -= $cantidad;
            $this->save();
            return true;
        }
        return false;
    }

    // Aumentar stock
    public function aumentarStock($cantidad)
    {
        $this->stock += $cantidad;
        $this->save();
    }
}
