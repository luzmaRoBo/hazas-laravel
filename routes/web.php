<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


//routas para las tablas de la base de datos
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HazasControlador;
use App\Http\Controllers\PadronHabitantesControlador;
use App\Http\Controllers\JuntaHazasControlador;
use App\Http\Controllers\HerederosControlador;
use App\Http\Controllers\PadronColonosControlador;
use App\Http\Controllers\SorteoControlador;
use App\Http\Controllers\UsuariosControlador;
use App\Http\Controllers\LoginControlador;
use App\Http\Middleware\AuthCheck;
use App\Http\Controllers\RegistroControlador;

//RUTAS PÚBLICAS: login y registro
//ruta para el login que sea la primera página que se ve
Route::get('/', [LoginControlador::class, 'login'])->name('login');
Route::post('/login', [LoginControlador::class, 'loginCreate'])->name('login.create'); //para iniciar sesion
Route::get('/registro', [RegistroControlador::class, 'registro'])->name('registro'); //visual pagina registro
Route::post('/registro', [RegistroControlador::class, 'store'])->name('registro.store'); //registrar usuarios

// RUTAS PROTEGIDAS: requieren inicio de sesión
Route::middleware([AuthCheck::class])->group(function () {
    Route::post('/logout', [LoginControlador::class, 'logout'])->name('logout'); //para cerrar sesión


    //ruta para la página de inicio
    Route::get('inicio', HomeController::class)->name('inicio');

    //rutas para la tabla HAZAS
    Route::controller(HazasControlador::class)->group(function () {
        Route::get('hazas/show', 'show')->name('hazas.show'); //listado de hazas
        Route::get('hazas/create', 'create')->name('hazas.create'); //formulario de nuevas hazas
        Route::post('hazas/store', 'store')->name('hazas.store'); //guardar una nueva haza
        Route::delete('hazas/{idHaza}', 'destroy')->name('hazas.destroy'); //borrar haza existentee
        Route::get('hazas/{idHaza}/edit', 'edit')->name('hazas.edit'); //mostrar datos de un haza existente
        Route::put('hazas/{idHaza}', 'update')->name('hazas.update'); //actualizar datos de un haza existente
    });

    //rutas para la tabla PADRON HABITANTES de la base de datos
    Route::controller(PadronHabitantesControlador::class)->group(function () {
        Route::get('padronHabitantes/show', 'show')->name('padronHabitantes.show'); // listado de habitantes
        Route::get('padronHabitantes/create', 'create')->name('padronHabitantes.create'); // formulario nuevo
        Route::post('padronHabitantes/store', 'store')->name('padronHabitantes.store'); // guardar nuevo
        Route::delete('padronHabitantes/{idHabitante}', 'destroy')->name('padronHabitantes.destroy'); // borrar
        Route::get('padronHabitantes/{idHabitante}/edit', 'edit')->name('padronHabitantes.edit'); // editar
        Route::put('padronHabitantes/{idHabitante}', 'update')->name('padronHabitantes.update'); // actualizar
    });

    //rutas para la tabla JUNTA DE HAZAS de la base de datos
    Route::controller(JuntaHazasControlador::class)->group(function () {
        Route::get('juntaHazas/show', 'show')->name('juntaHazas.show');    // listado de juntas
        Route::get('juntaHazas/create',  'create')->name('juntaHazas.create');  // formulario nuevo
        Route::post('juntaHazas/store',  'store')->name('juntaHazas.store');    // guardar nuevo
        Route::delete('juntaHazas/{idJuntaHazas}', 'destroy')->name('juntaHazas.destroy'); // borrar
        Route::get('juntaHazas/{idJuntaHazas}/edit',   'edit')->name('juntaHazas.edit');   // editar
        Route::put('juntaHazas/{idJuntaHazas}',        'update')->name('juntaHazas.update'); // actualizar
    });

    //rutas para la tabla HEREDEROS de la base de datos
    // Route::controller(HerederosControlador::class)->group(function () {
    //     Route::get('herederos/create', 'create')->name('herederos.create');
    //     Route::get('herederos/show', 'show')->name('herederos.show');
    // });

    //rutas para la tabla PADRÓN COLONOS de la base de datos
    Route::controller(PadronColonosControlador::class)->group(function () {
        Route::get('padronColonos/show',    'show')->name('colonos.show');    // listado de colonos
        Route::get('padronColonos/create',  'create')->name('colonos.create');  // formulario nuevo
        Route::post('padronColonos/store',  'store')->name('colonos.store');    // guardar nuevo
        Route::delete('padronColonos/{idColono}', 'destroy')->name('colonos.destroy'); // borrar
        Route::get('padronColonos/{idColono}/edit',   'edit')->name('colonos.edit');   // editar
        Route::put('padronColonos/{idColono}',        'update')->name('colonos.update'); // actualizar
    });

    //rutas para la tabla SORTEO de la base de datos
    // Route::controller(SorteoControlador::class)->group(function () {
    //     Route::get('sorteo/create', 'create')->name('sorteo.create');
    //     Route::get('sorteo/show', 'show')->name('sorteo.show');
    // });

    //rutas para la tabla USUARIOS de la base de datos
    Route::controller(UsuariosControlador::class)->group(function () {
        Route::get('usuarios/show', 'show')->name('usuarios.show'); // listado de usuarios
        Route::get('usuarios/create', 'create')->name('usuarios.create'); // formulario nuevo
        Route::post('usuarios/store', 'store')->name('usuarios.store'); // guardar nuevo
        Route::delete('usuarios/{idUsuario}', 'destroy')->name('usuarios.destroy'); // borrar
        Route::get('usuarios/{idUsuario}/edit', 'edit')->name('usuarios.edit'); // editar
        Route::put('usuarios/{idUsuario}', 'update')->name('usuarios.update'); // actualizar
    });
});
