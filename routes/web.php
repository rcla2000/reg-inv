<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;
use App\Models\Investigador;
use Illuminate\Support\Facades\DB;

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
Route::get('/municipios/{idDepartamento}', [RegistroController::class, 'listarMunicipios'])->name('municipios.listar');
Route::post('/investigadores/registro', [RegistroController::class, 'guardarInvestigador'])->name('registro.guardar');
Route::get('/prueba', function() {
    $nTramite = DB::select("SELECT `AUTO_INCREMENT` as tramite FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_SCHEMA = 'investigadores_cyt'
    AND TABLE_NAME = 'investigadores';");
    return $nTramite[0]->tramite;
});
