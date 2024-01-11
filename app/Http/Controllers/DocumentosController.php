<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigador;
use App\Models\Observacion;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function mostrar($idInvestigador, $tabla, $idDocumento) {
        $investigador = Investigador::findOrFail($idInvestigador);
        $doc = null;

        switch ($tabla) {
            case 'ga':
                $doc = $investigador->docs_grados_academicos->find($idDocumento);
            break;
            case 'par':
                $doc = $investigador->docs_participacion_cyts->find($idDocumento);
            break;
            case 'des':
                $doc = $investigador->docs_desempeno_cyts->find($idDocumento);
            break;
            case 'pub':
                $doc = $investigador->docs_publicaciones_cyts->find($idDocumento);
            break;
        }

        if ($doc === null) {
            return abort(404);
        }

        return view('gestion.revision-doc', compact('doc', 'investigador', 'tabla'));
    }

    function agregarObservacion(Request $request) {
        $datos = $request->validate([
            'observacion' => 'required|string',
            'tabla' => 'required|string',
            'id_documento' => 'required',
            'id_investigador' => 'required'
        ]);

        try {
            DB::beginTransaction();

            Observacion::create($datos);
            $investigador = Investigador::find($request->id_investigador);

            if ($investigador === null) {
                Alert::error('Error', 'No se encontró el investigador asociado a este documento');
                return back();
            }

            $investigador->id_estado = 2;
            $investigador->save();

            DB::commit();

            Alert::success('Información', 'La observación sobre este documento ha sido almacenada exitosamente');
        } catch (Exception) {
            DB::rollBack();
            Alert::error('Error', 'No se pudo agregar la observación al documento');
        } finally {
            return back();
        }
    }

    function eliminarObservacion(Request $request) {
        try {
            DB::beginTransaction();
            Observacion::destroy($request->id_observacion);
            DB::commit();
            return response()->json(['message' => 'La observación ha sido eliminada exitosamente']);
        } catch (Exception) {
            DB::rollback();
            return response()->json(['message' => 'Ha ocurrido un error al eliminar la observación'], 500);
        }   
    }
}
