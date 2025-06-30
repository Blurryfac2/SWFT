@echo off
echo ========================================
echo  INSTALADOR AUTOMATICO - PIROTECNIA
echo  Sistema de Gestion con Roles v2.0
echo ========================================
echo.

REM Verificar si estamos en un proyecto Laravel
if not exist "artisan" (
    echo ERROR: No se encontro el archivo artisan.
    echo Asegurate de ejecutar este script desde la raiz de tu proyecto Laravel.
    pause
    exit /b 1
)

echo [1/8] Creando directorios necesarios...
if not exist "app\Http\Middleware" mkdir "app\Http\Middleware"
if not exist "database\seeders" mkdir "database\seeders"
if not exist "resources\views\layouts" mkdir "resources\views\layouts"
if not exist "resources\views\productos" mkdir "resources\views\productos"

echo [2/8] Copiando migraciones...
copy "2024_01_01_000003_create_productos_table.php" "database\migrations\" >nul
copy "2024_01_01_000004_add_rol_to_users_table.php" "database\migrations\" >nul

echo [3/8] Copiando modelos...
copy "Producto.php" "app\Models\" >nul
copy "User_updated.php" "app\Models\User.php" >nul

echo [4/8] Copiando controladores...
copy "ProductoController_updated.php" "app\Http\Controllers\ProductoController.php" >nul

echo [5/8] Copiando middleware...
copy "RolMiddleware.php" "app\Http\Middleware\" >nul

echo [6/8] Copiando rutas...
copy "web_updated.php" "routes\web.php" >nul
copy "api_updated.php" "routes\api.php" >nul

echo [7/8] Copiando vistas...
copy "app_updated.blade.php" "resources\views\layouts\app.blade.php" >nul
copy "index_updated.blade.php" "resources\views\productos\index.blade.php" >nul
copy "create.blade.php" "resources\views\productos\" >nul
copy "show.blade.php" "resources\views\productos\" >nul
copy "edit.blade.php" "resources\views\productos\" >nul

echo [8/8] Copiando seeders...
copy "UserSeeder.php" "database\seeders\" >nul

echo.
echo ========================================
echo  ARCHIVOS COPIADOS EXITOSAMENTE
echo ========================================
echo.
echo PASOS SIGUIENTES:
echo.
echo 1. Agregar middleware al archivo app\Http\Kernel.php
echo    (Ver instrucciones en kernel_middleware_config.txt)
echo.
echo 2. Ejecutar migraciones:
echo    php artisan migrate
echo.
echo 3. Crear enlace simbolico para storage:
echo    php artisan storage:link
echo.
echo 4. Ejecutar seeder para crear usuarios:
echo    php artisan db:seed --class=UserSeeder
echo.
echo 5. Limpiar cache:
echo    php artisan route:clear
echo    php artisan config:clear
echo    php artisan view:clear
echo.
echo ========================================
echo  USUARIOS CREADOS POR EL SEEDER:
echo ========================================
echo.
echo TEST USER:
echo   Email: test@pirotecnia.com
echo   Password: password123
echo   Rol: Usuario de Prueba
echo.
echo ADMIN BASE:
echo   Email: admin@pirotecnia.com  
echo   Password: admin123
echo   Rol: Administrador Base
echo.
echo SUPER ADMIN:
echo   Email: superadmin@pirotecnia.com
echo   Password: superadmin123
echo   Rol: Administrador Full
echo.
echo ========================================
echo  INSTALACION COMPLETADA
echo ========================================
echo.
echo Presiona cualquier tecla para continuar...
pause >nul
