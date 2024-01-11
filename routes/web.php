<?php

use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\GestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas para dar de alta a investigadores
Route::view('/', 'bienvenida')->name('bienvenida');
Route::get('/registro', [RegistroController::class, 'inicio'])->name('registro.inicio');
Route::post('/registro', [RegistroController::class, 'guardarInvestigador'])->name('registro.guardar');
Route::get('/calificaciones-maximas', [RegistroController::class, 'calificacionesMaximasEstablecidas'])->name('calificaciones-maximas');
Route::get('/municipios/{id}', [RegistroController::class, 'listarMunicipios'])->name('municipios.listar');
Route::post('/registro/verificar-existencia-de-registro', [RegistroController::class, 'existeRegistro'])->name('registro.existe');

Route::get('/prueba', function () {
    $pdf = PDF::loadView('gestion.constancia');
    return $pdf->download('constancia.pdf');
   // echo storage_path('fonts\BemboStd.otf');
  
});

// Rutas para gestionar registros almacenados de investigadores
Route::get('/gestion/investigadores', [GestionController::class, 'listarInvestigadores'])->name('investigadores.inicio');
Route::get('/gestion/investigadores/{id}', [GestionController::class, 'mostrarInvestigador'])->name('investigadores.mostrar');
Route::post('/gestion/investigadores/actualizar-estado', [GestionController::class, 'actualizarEstadoInvestigador'])->name('investigador.estado.actualizar');
Route::post('/gestion/investigadores/eliminar', [GestionController::class, 'eliminarInvestigador'])->name('investigadores.eliminar');
Route::post('/gestion/investigadores/emitir-constancia', [GestionController::class, 'emitirConstancia'])->name('investigador.generar.constancia');

// Rutas para revisión de documentación
Route::get('/gestion/investigadores/{idInvestigador}/documentos/{tabla}/{idDocumento}', 
[DocumentosController::class, 'mostrar'])->name('investigadores.documento.mostrar');
Route::post('/gestion/investigadores/documentos/agregar-observacion',
[DocumentosController::class, 'agregarObservacion'])->name('documentos.observaciones.agregar');
Route::post('/gestion/investigadores/documentos/eliminar-observacion',
[DocumentosController::class, 'eliminarObservacion'])->name('documentos.observaciones.eliminar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
