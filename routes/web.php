
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DesarrolladoraController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\AuthController;

// Página principal
Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticación: disponibles sin iniciar sesión
Route::get('/login', [AuthController::class, 'mostrarLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// Módulos protegidos
Route::middleware('auth')->group(function () {

    // Cerrar sesión: cualquier usuario autenticado
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // =====================================
    // CATÁLOGO: TODOS LOS ROLES
    // =====================================

    Route::get('videojuego', [VideojuegoController::class, 'getVideojuegos'])
        ->name('getvideojuegos');

    Route::get('resena', [ResenaController::class, 'getResenas'])
        ->name('getresenas');

    // Reseñas
    Route::post('create/resena', [ResenaController::class, 'createResena'])
    ->name('resena.create');

    Route::put('update/resena/{id}', [ResenaController::class, 'updateResena'])
    ->name('resena.update');

    Route::delete('delete/resena/{id}', [ResenaController::class, 'deleteResena'])
    ->name('resena.delete');

    // =====================================
    // ADMINISTRADOR Y EMPLEADO
    // =====================================

    Route::middleware('rol:Administrador,Empleado')->group(function () {

        // Clientes
        Route::get('cliente', [ClienteController::class, 'getClientes'])
            ->name('getclientes');
        Route::post('create/cliente', [ClienteController::class, 'createCliente'])
            ->name('cliente.create');
        Route::put('update/cliente/{id}', [ClienteController::class, 'updateCliente'])
            ->name('cliente.update');
        Route::delete('delete/cliente/{id}', [ClienteController::class, 'deleteCliente'])
            ->name('cliente.delete');

        // Categorías
        Route::get('categoria', [CategoriaController::class, 'getCategorias'])
            ->name('getcategorias');
        Route::post('create/categoria', [CategoriaController::class, 'createCategoria'])
            ->name('categoria.create');
        Route::put('update/categoria/{id}', [CategoriaController::class, 'updateCategoria'])
            ->name('categoria.update');
        Route::delete('delete/categoria/{id}', [CategoriaController::class, 'deleteCategoria'])
            ->name('categoria.delete');

        // Desarrolladoras
        Route::get('desarrolladora', [DesarrolladoraController::class, 'getDesarrolladoras'])
            ->name('getdesarrolladoras');
        Route::post('create/desarrolladora', [DesarrolladoraController::class, 'createDesarrolladora'])
            ->name('desarrolladora.create');
        Route::put('update/desarrolladora/{id}', [DesarrolladoraController::class, 'updateDesarrolladora'])
            ->name('desarrolladora.update');
        Route::delete('delete/desarrolladora/{id}', [DesarrolladoraController::class, 'deleteDesarrolladora'])
            ->name('desarrolladora.delete');

        // Plataformas
        Route::get('plataforma', [PlataformaController::class, 'getPlataformas'])
            ->name('getplataformas');
        Route::post('create/plataforma', [PlataformaController::class, 'createPlataforma'])
            ->name('plataforma.create');
        Route::put('update/plataforma/{id}', [PlataformaController::class, 'updatePlataforma'])
            ->name('plataforma.update');
        Route::delete('delete/plataforma/{id}', [PlataformaController::class, 'deletePlataforma'])
            ->name('plataforma.delete');

        // Inventario
        Route::get('inventario', [InventarioController::class, 'getInventario'])
            ->name('getinventario');
        Route::post('create/inventario', [InventarioController::class, 'createInventario'])
            ->name('inventario.create');
        Route::put('update/inventario/{id}', [InventarioController::class, 'updateInventario'])
            ->name('inventario.update');
        Route::delete('delete/inventario/{id}', [InventarioController::class, 'deleteInventario'])
            ->name('inventario.delete');

        // Métodos de pago
        Route::get('metodo-pago', [MetodoPagoController::class, 'getMetodosPago'])
            ->name('getmetodospago');
        Route::post('create/metodo-pago', [MetodoPagoController::class, 'createMetodoPago'])
            ->name('metodopago.create');
        Route::put('update/metodo-pago/{id}', [MetodoPagoController::class, 'updateMetodoPago'])
            ->name('metodopago.update');
        Route::delete('delete/metodo-pago/{id}', [MetodoPagoController::class, 'deleteMetodoPago'])
            ->name('metodopago.delete');

        // Ventas
        Route::get('venta', [VentaController::class, 'getVentas'])
            ->name('getventas');
        Route::post('create/venta', [VentaController::class, 'createVenta'])
            ->name('venta.create');
        Route::put('update/venta/{id}', [VentaController::class, 'updateVenta'])
            ->name('venta.update');
        Route::delete('delete/venta/{id}', [VentaController::class, 'deleteVenta'])
            ->name('venta.delete');

        // Detalles de venta
        Route::get('detalle-venta', [DetalleVentaController::class, 'getDetallesVenta'])
            ->name('getdetallesventa');

        // Crear videojuegos
        Route::post('create/videojuego', [VideojuegoController::class, 'createVideojuego'])
            ->name('videojuego.create');
        Route::put('update/videojuego/{id}', [VideojuegoController::class, 'updateVideojuego'])
            ->name('videojuego.update');
        Route::delete('delete/videojuego/{id}', [VideojuegoController::class, 'deleteVideojuego'])
            ->name('videojuego.delete');
    });

    // =====================================
    // SOLO ADMINISTRADOR
    // =====================================

    Route::middleware('rol:Administrador')->group(function () {

        // Roles
        Route::get('rol', [RolController::class, 'getRoles'])
            ->name('getroles');
        Route::post('create/rol', [RolController::class, 'createRol'])
            ->name('rol.create');
        Route::put('update/rol/{id}', [RolController::class, 'updateRol'])
            ->name('rol.update');
        Route::delete('delete/rol/{id}', [RolController::class, 'deleteRol'])
            ->name('rol.delete');

        // Usuarios
        Route::get('usuario', [UsuarioController::class, 'getUsuarios'])
            ->name('getusuarios');
        Route::post('create/usuario', [UsuarioController::class, 'createUsuario'])
            ->name('usuario.create');
        Route::put('update/usuario/{id}', [UsuarioController::class, 'updateUsuario'])
            ->name('usuario.update');
        Route::delete('delete/usuario/{id}', [UsuarioController::class, 'deleteUsuario'])
            ->name('usuario.delete');
    });
});