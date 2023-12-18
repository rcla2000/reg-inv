<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\GestionController;
use Illuminate\Support\Facades\Route;
use App\Models\Investigador;


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

Route::view('/', 'bienvenida')->name('bienvenida');
Route::get('/registro', [RegistroController::class, 'inicio'])->name('registro.inicio');
Route::post('/registro', [RegistroController::class, 'guardarInvestigador'])->name('registro.guardar');
Route::get('/calificaciones-maximas', [RegistroController::class, 'calificacionesMaximasEstablecidas']);
Route::get('/municipios/{id}', [RegistroController::class, 'listarMunicipios']);

Route::view('/pdf', 'gestion.visor-pdf');
Route::view('/constancia', 'gestion.constancia');

Route::get('/prueba', function () {
    // $pdf = PDF::loadView('gestion.constancia');
    // return $pdf->download('constancia.pdf');
  
});

// Rutas para gestionar registros de investigadores
Route::get('/gestion/investigadores', [GestionController::class, 'listarInvestigadores'])->name('investigadores.inicio');
Route::get('/gestion/investigadores/{id}', [GestionController::class, 'mostrarInvestigador'])->name('investigadores.mostrar');
Route::get('/gestion/investigadores/{idInvestigador}/documentos/{tabla}/{idDocumento}', 
[GestionController::class, 'mostrarDocumentoInvestigador'])->name('investigadores.documento.mostrar');
Route::post('/gestion/investigadores/actualizar-estado', [GestionController::class, 'actualizarEstadoInvestigador']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
