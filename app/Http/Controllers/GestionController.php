<?php

namespace App\Http\Controllers;

use App\Models\DocsDesempenoCyt;
use App\Models\DocsGradosAcademico;
use App\Models\DocsParticipacionCyt;
use App\Models\DocsPublicacionesCyt;
use App\Models\Investigador;
use Exception;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function listarInvestigadores() {
        $investigadores = Investigador::select('id_investigador',
            'dui','primer_nombre', 'segundo_nombre', 'primer_apellido', 
            'segundo_apellido', 'email', 'telefono')->paginate(20);

        return view('gestion.inicio', compact('investigadores'));
    }

    function mostrarInvestigador($id) {
        $investigador = Investigador::findOrFail($id);

        $observaciones = $investigador->observaciones;
        $doc = null;
        $documentos = [];

        if (count($observaciones) > 0) {
            foreach ($observaciones as $o) {
                switch ($o->tabla) {
                    case 'ga':
                        $doc = DocsGradosAcademico::find($o->id_documento);
                    break;
                    case 'par':
                        $doc = DocsParticipacionCyt::find($o->id_documento);
                    break;
                    case 'des':
                        $doc = DocsDesempenoCyt::find($o->id_documento);
                    break;
                    case 'pub':
                        $doc = DocsPublicacionesCyt::find($o->id_documento);
                    break;
                }

                array_push($documentos, $doc);
            }
        }

        return view('gestion.revision', compact('investigador', 'documentos'));
    }

    function actualizarEstadoInvestigador(Request $request) {
        $investigador = Investigador::find($request->idInvestigador);

        if ($investigador !== null) {
            try {
                $investigador->id_estado = $request->idEstado;
                $investigador->save();
                return response()->json(
                    [
                        'message' => $request->idEstado == 3 ? 'Investigador aprobado exitosamente' : 'El investigador ha sido denegado'
                    ]
                );
            } catch (Exception $e) {
                return response()->json(['message' => 'Ha ocurrido un error al actualizar el estado del investigador'], 500);
            }
        }
        return response()->json(['message' => 'No se encontró el registro del investigador'], 400);
    }
}
