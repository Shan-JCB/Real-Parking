<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ParqueoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TarifaController;

Auth::routes();

Route::get('/', function () {return view('auth.login');});

//Route::get('/home', [HomeController::class, 'index'])->name('home');

//Rutas Admin
Route::get('/admin', [AdminController::class, 'index'])->name('tasks.index')->middleware('auth');

//Rutas Admin: Usuario
Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth','can:usuarios.index');
Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth','can:usuarios.create');
Route::post('/admin/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth','can:usuarios.store');
Route::get('/admin/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth','can:usuarios.show');
Route::get('/admin/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth','can:usuarios.edit');
Route::put('/admin/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth','can:usuarios.update');
Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth','can:usuarios.destroy');

//Rutas Admin: Operdaores
Route::get('/admin/operadores', [OperadorController::class, 'index'])->name('admin.operadores.index')->middleware('auth','can:admin.operadores.index');
Route::get('/admin/operadores/create', [OperadorController::class, 'create'])->name('admin.operadores.create')->middleware('auth','can:admin.operadores.create');
Route::post('/admin/operadores/create', [OperadorController::class, 'store'])->name('admin.operadores.store')->middleware('auth','can:admin.operadores.store');
Route::get('/admin/operadores/{id}', [OperadorController::class, 'show'])->name('admin.operadores.show')->middleware('auth','can:admin.operadores.show');
Route::get('/admin/operadores/{id}/edit', [OperadorController::class, 'edit'])->name('admin.operadores.edit')->middleware('auth','can:admin.operadores.edit');
Route::put('/admin/operadores/{id}', [OperadorController::class, 'update'])->name('admin.operadores.update')->middleware('auth','can:admin.operadores.update');
Route::delete('/admin/operadores/{id}', [OperadorController::class, 'destroy'])->name('admin.operadores.destroy')->middleware('auth','can:admin.operadores.destroy');

//Rutas Admin: Clientes
Route::get('/admin/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth','can:admin.clientes.index');
Route::get('/admin/clientes/create', [ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth','can:admin.clientes.create');
Route::post('/admin/clientes/create', [ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth','can:admin.clientes.store');
Route::get('/admin/clientes/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth','can:admin.clientes.show');
Route::get('/admin/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth','can:admin.clientes.edit');
Route::put('/admin/clientes/basica/{id}', [ClienteController::class, 'updateBasica'])->name('admin.clientes.updateBasica','can:admin.clientes.updateBasica');
Route::put('/admin/clientes/relevante/{id}', [ClienteController::class, 'updateRelevante'])->name('admin.clientes.updateRelevante','can:admin.clientes.updateRelevante');
Route::get('/admin/clientes/{id}/confirm-delete', [ClienteController::class, 'confirmDelete'])->name('admin.clientes.confirmDelete')->middleware('auth','admin.can:clientes.confirmDelete');
Route::delete('/admin/clientes/{id}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth','can:admin.clientes.destroy');

//Rutas Admin: Parqueos
Route::get('/admin/parqueos', [ParqueoController::class, 'index'])->name('admin.parqueos.index')->middleware('auth','can:admin.parqueos.index');
Route::get('/admin/parqueos/create', [ParqueoController::class, 'create'])->name('admin.parqueos.create')->middleware('auth','can:admin.parqueos.create');
Route::post('/admin/parqueos/create', [ParqueoController::class, 'store'])->name('admin.parqueos.store')->middleware('auth','can:admin.parqueos.store');
Route::get('/admin/parqueos/{id}/edit', [ParqueoController::class, 'edit'])->name('admin.parqueos.edit')->middleware('auth','can:admin.parqueos.edit');
Route::put('/admin/parqueos/{id}', [ParqueoController::class, 'update'])->name('admin.parqueos.update')->middleware('auth','can:admin.parqueos.update');
Route::post('/admin/parqueos/buscar-cliente', [ParqueoController::class, 'buscarClientePorPlaca'])->name('buscar.cliente')->middleware('auth','can:buscar.cliente');

////Rutas Admin: Eventos
Route::post('/admin/eventos/create', [EventController::class, 'store'])->name('admin.eventos.create')->middleware('auth','can:admin.eventos.create');
Route::delete('/admin/eventos/{id}/delete', [EventController::class, 'destroy'])->name('eventos.destroy','can:eventos.destroy');
Route::get('/admin/eventos/{id}/print', [EventController::class, 'printTicket'])->name('eventos.print','can:eventos.print');

//Rutas Admin: Pagos
Route::get('/admin/pagos', [PagoController::class, 'index'])->name('admin.pagos.index')->middleware('auth','can:admin.pagos.index');
Route::get('/admin/pagos/create', [PagoController::class, 'create'])->name('admin.pagos.create')->middleware('auth','can:admin.pagos.create');
Route::post('/admin/pagos/create', [PagoController::class, 'store'])->name('admin.pagos.store')->middleware('auth','can:admin.pagos.store');
Route::get('/admin/pagos/{id}', [PagoController::class, 'show'])->name('admin.pagos.show')->middleware('auth','can:admin.pagos.show');
Route::get('/admin/pagos/{id}/edit', [PagoController::class, 'edit'])->name('admin.pagos.edit')->middleware('auth','can:admin.pagos.edit');
Route::put('/admin/pagos/{id}', [PagoController::class, 'update'])->name('admin.pagos.update')->middleware('auth','can:admin.pagos.update');
Route::delete('/admin/pagos/{id}', [PagoController::class, 'destroy'])->name('admin.pagos.destroy')->middleware('auth','can:admin.pagos.destroy');
Route::get('/admin/pagos/{id}/imprimir-factura', [PagoController::class, 'imprimirFactura'])->name('admin.pagos.imprimirFactura')->middleware('auth','can:admin.pagos.imprimirFactura');
Route::post('/admin/pagos/procesar', [PagoController::class, 'procesarPago'])->name('pagos.procesar')->middleware('auth','can:pagos.procesar');

//Rutas Admin: Tarifas
Route::get('/admin/tarifas', [TarifaController::class, 'index'])->name('admin.tarifas.index')->middleware('auth','can:admin.tarifas.index');
Route::get('/admin/tarifas/create', [TarifaController::class, 'create'])->name('admin.tarifas.create')->middleware('auth','can:admin.tarifas.create');
Route::post('/admin/tarifas/create', [TarifaController::class, 'store'])->name('admin.tarifas.store')->middleware('auth','can:admin.tarifas.store');
Route::get('/admin/tarifas/{id}', [TarifaController::class, 'show'])->name('admin.tarifas.show')->middleware('auth','can:admin.tarifas.show');
Route::get('/admin/tarifas/{id}/edit', [TarifaController::class, 'edit'])->name('admin.tarifas.edit')->middleware('auth','can:admin.tarifas.edit');
Route::put('/admin/tarifas/{id}', [TarifaController::class, 'update'])->name('admin.tarifas.update')->middleware('auth','can:admin.tarifas.update');
Route::delete('/admin/tarifas/{id}', [TarifaController::class, 'destroy'])->name('admin.tarifas.destroy')->middleware('auth','can:admin.tarifas.destroy');
