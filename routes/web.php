<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\GestionController;
use Illuminate\Support\Facades\Route;
use App\Models\Puntaje;


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

// Rutas para gestionar registros de investigadores
Route::get('/gestion/investigadores', [GestionController::class, 'listarInvestigadores'])->name('investigadores.inicio');
Route::get('/gestion/investigadores/{id}', [GestionController::class, 'mostrarInvestigador'])->name('investigadores.mostrar');
Route::post('/gestion/investigadores/actualizar-estado', [GestionController::class, 'actualizarEstadoInvestigador']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/prueba', function() {
    $idPuntajeMaximo = Puntaje::select('id_puntaje')
        ->where('puntaje_min', function ($queryBuilder) {
            $queryBuilder->select(DB::raw('MAX(puntaje_min) as puntaje_min'))->from('puntajes')->first();
        })->first()->id_puntaje;

    $puntaje = Puntaje::find($idPuntajeMaximo);
    return $puntaje;

});

require __DIR__.'/auth.php';
