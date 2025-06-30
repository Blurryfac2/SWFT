# Sistema de Gestión de Productos con Roles - Pirotecnia v2.0

## 🚀 INSTALACIÓN AUTOMÁTICA

### Opción 1: Usar el instalador BAT (Windows)
1. Coloca todos los archivos descargados en la raíz de tu proyecto Laravel
2. Ejecuta `instalar.bat`
3. Sigue las instrucciones que aparecen en pantalla

### Opción 2: Instalación manual

#### 1. Colocar archivos en ubicaciones correctas:

**Migraciones:**
- `2024_01_01_000003_create_productos_table.php` → `database/migrations/`
- `2024_01_01_000004_add_rol_to_users_table.php` → `database/migrations/`

**Modelos:**
- `Producto.php` → `app/Models/`
- `User_updated.php` → `app/Models/User.php` (reemplazar)

**Controladores:**
- `ProductoController_updated.php` → `app/Http/Controllers/ProductoController.php`

**Middleware:**
- `RolMiddleware.php` → `app/Http/Middleware/`

**Rutas:**
- `web_updated.php` → `routes/web.php` (reemplazar)
- `api_updated.php` → `routes/api.php` (reemplazar)

**Vistas:**
- `app_updated.blade.php` → `resources/views/layouts/app.blade.php`
- `index_updated.blade.php` → `resources/views/productos/index.blade.php`
- `create.blade.php` → `resources/views/productos/`
- `show.blade.php` → `resources/views/productos/`
- `edit.blade.php` → `resources/views/productos/`

**Seeders:**
- `UserSeeder.php` → `database/seeders/`

#### 2. Registrar middleware en `app/Http/Kernel.php`:

Agregar en el array `$middlewareAliases`:
```php
'rol' => \App\Http\Middleware\RolMiddleware::class,
```

#### 3. Ejecutar comandos:

```bash
# Ejecutar migraciones
php artisan migrate

# Crear enlace simbólico para storage
php artisan storage:link

# Ejecutar seeder para crear usuarios
php artisan db:seed --class=UserSeeder

# Limpiar cache
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

## 👥 SISTEMA DE ROLES

### 3 Niveles de Acceso:

#### 🧪 **TEST** (Usuario de Prueba)
- **Permisos:** Solo lectura
- **Puede:** Ver productos, descargar logs
- **No puede:** Crear, editar o eliminar productos
- **Características especiales:**
  - Todas sus acciones se registran en logs
  - Puede descargar archivo de logs para análisis
  - Interfaz especial que indica modo de prueba

#### ⚙️ **ADMIN_BASE** (Administrador Base)
- **Permisos:** CRUD completo de productos
- **Puede:** Crear, editar, eliminar productos, gestionar stock
- **No puede:** Acciones críticas del sistema
- **Características:**
  - Gestión completa de inventario
  - Cambiar estados de productos
  - Subir/cambiar imágenes

#### 🔥 **ADMIN_FULL** (Administrador Full)
- **Permisos:** Acceso completo + acciones críticas
- **Puede:** Todo lo de admin_base + acciones críticas
- **Acciones críticas:**
  - Eliminar TODOS los productos
  - Limpiar logs del sistema
  - Acceso a configuraciones avanzadas

## 🔐 USUARIOS PREDETERMINADOS

El seeder crea estos usuarios automáticamente:

| Rol | Email | Password | Descripción |
|-----|-------|----------|-------------|
| **test** | test@pirotecnia.com | password123 | Usuario de prueba principal |
| **admin_base** | admin@pirotecnia.com | admin123 | Administrador estándar |
| **admin_full** | superadmin@pirotecnia.com | superadmin123 | Super administrador |
| **test** | juan.test@pirotecnia.com | test123 | Usuario de prueba adicional |
| **admin_base** | maria.admin@pirotecnia.com | admin123 | Admin adicional |

## 🎯 FUNCIONALIDADES POR ROL

### Para Usuarios TEST:
- ✅ Ver lista de productos
- ✅ Ver detalles de productos
- ✅ Descargar logs de actividad
- ❌ Crear/editar/eliminar productos
- 🔍 **Logging especial:** Todas las acciones se registran

### Para Administradores BASE:
- ✅ Todo lo de TEST +
- ✅ Crear nuevos productos
- ✅ Editar productos existentes
- ✅ Eliminar productos individuales
- ✅ Gestionar stock (agregar/quitar/establecer)
- ✅ Activar/desactivar productos
- ✅ Subir y cambiar imágenes
- ❌ Acciones críticas del sistema

### Para Administradores FULL:
- ✅ Todo lo de ADMIN_BASE +
- 🔥 **ELIMINAR TODOS LOS PRODUCTOS** (acción crítica)
- 🔥 **Limpiar logs del sistema** (acción crítica)
- 🔥 Acceso a zona de acciones críticas
- 🔥 Confirmaciones dobles para acciones destructivas

## 🛡️ SEGURIDAD IMPLEMENTADA

### Middleware de Roles:
- Verificación automática de permisos
- Redirección a login si no está autenticado
- Error 403 si no tiene permisos suficientes

### Protección de Rutas:
```php
// Solo usuarios autenticados
Route::middleware('auth')->group(function () {
    // Solo test, admin_base, admin_full pueden ver
    Route::middleware('rol:test,admin_base,admin_full')->group(function () {
        // Rutas de lectura
    });

    // Solo admin_base y admin_full pueden modificar
    Route::middleware('rol:admin_base,admin_full')->group(function () {
        // Rutas de escritura
    });

    // Solo admin_full puede hacer acciones críticas
    Route::middleware('rol:admin_full')->group(function () {
        // Acciones críticas
    });
});
```

### Validaciones en Vistas:
```blade
@if(Auth::user()->isAdmin())
    <!-- Botones de admin -->
@endif

@if(Auth::user()->isTest())
    <!-- Funciones de test -->
@endif

@if(Auth::user()->isAdminFull())
    <!-- Zona crítica -->
@endif
```

## 📊 SISTEMA DE LOGS

### Para Usuarios TEST:
- Se registra cada acción (ver productos, acceder a secciones)
- Pueden descargar logs en formato .txt
- Logs incluyen: timestamp, usuario, acción realizada

### Para Administradores:
- Se registran cambios en productos
- Se registran cambios de stock
- Se registran eliminaciones
- Logs incluyen: datos anteriores y nuevos

### Para Admin FULL:
- Se registran acciones críticas
- Logs de nivel WARNING/CRITICAL
- Pueden limpiar logs del sistema

## 🎨 INTERFAZ DE USUARIO

### Indicadores Visuales:
- **Badges de rol** con colores distintivos
- **Zona crítica** resaltada para admin_full
- **Modo de prueba** destacado para usuarios test
- **Confirmaciones dobles** para acciones destructivas

### Navegación Inteligente:
- Menús adaptativos según rol
- Botones ocultos/mostrados según permisos
- Mensajes contextuales por rol

## 🔧 PERSONALIZACIÓN

### Agregar Nuevos Roles:
1. Modificar migración de usuarios
2. Agregar métodos en modelo User
3. Actualizar middleware
4. Modificar vistas según necesidades

### Cambiar Permisos:
1. Modificar rutas en `web.php`
2. Actualizar validaciones en controlador
3. Modificar vistas blade

## 🚨 NOTAS IMPORTANTES

### Seguridad:
- Cambiar passwords por defecto en producción
- Configurar correctamente el archivo `.env`
- Usar HTTPS en producción
- Configurar rate limiting para APIs

### Backup:
- Hacer backup antes de usar acciones críticas
- Los logs se pueden limpiar permanentemente
- La eliminación masiva de productos es irreversible

### Performance:
- Los logs pueden crecer mucho con usuarios test activos
- Considerar rotación de logs en producción
- Optimizar consultas si hay muchos productos

## 📱 API CON ROLES (Opcional)

Si quieres proteger la API con roles, descomenta las rutas en `api.php`:

```php
Route::middleware('auth:sanctum')->group(function () {
    // API protegida
});
```

## 🎯 PRÓXIMAS MEJORAS

- [ ] Panel de administración de usuarios
- [ ] Historial de cambios por producto
- [ ] Notificaciones en tiempo real
- [ ] Exportar/importar productos
- [ ] Dashboard con estadísticas por rol
- [ ] Configuración de permisos granular
- [ ] Auditoría completa del sistema

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### Error 403 - Sin permisos:
- Verificar que el usuario tenga el rol correcto
- Comprobar que el middleware esté registrado
- Revisar las rutas protegidas

### No aparecen botones:
- Verificar directivas `@if(Auth::user()->isRol())`
- Comprobar que el usuario esté autenticado
- Revisar cache de vistas

### Logs no se descargan:
- Verificar permisos de storage
- Comprobar que exista el archivo de logs
- Verificar que el usuario sea de tipo test

¡Sistema completo con roles implementado exitosamente! 🎉
