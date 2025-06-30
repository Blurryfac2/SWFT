<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Verificar si el usuario es de tipo Test
     */
    public function isTest()
    {
        return $this->rol === 'test';
    }

    /**
     * Verificar si el usuario es Administrador Base
     */
    public function isAdminBase()
    {
        return $this->rol === 'admin_base';
    }

    /**
     * Verificar si el usuario es Administrador Full
     */
    public function isAdminFull()
    {
        return $this->rol === 'admin_full';
    }

    /**
     * Verificar si el usuario tiene permisos de administrador (base o full)
     */
    public function isAdmin()
    {
        return in_array($this->rol, ['admin_base', 'admin_full']);
    }

    /**
     * Obtener el nombre del rol formateado
     */
    public function getRolFormateadoAttribute()
    {
        $roles = [
            'test' => 'Usuario de Prueba',
            'admin_base' => 'Administrador Base',
            'admin_full' => 'Administrador Full'
        ];

        return $roles[$this->rol] ?? 'Rol Desconocido';
    }

    /**
     * Obtener el color del badge según el rol
     */
    public function getRolColorAttribute()
    {
        $colores = [
            'test' => 'info',
            'admin_base' => 'warning',
            'admin_full' => 'danger'
        ];

        return $colores[$this->rol] ?? 'secondary';
    }

    /**
     * Scope para filtrar usuarios por rol
     */
    public function scopeConRol($query, $rol)
    {
        return $query->where('rol', $rol);
    }

    /**
     * Scope para obtener solo administradores
     */
    public function scopeAdministradores($query)
    {
        return $query->whereIn('rol', ['admin_base', 'admin_full']);
    }
}
