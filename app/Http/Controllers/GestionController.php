<?php

namespace App\Http\Controllers;

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

    private function obtenerDocumentosInvestigador($idInvestigador) {
        
    }

    function mostrarInvestigador($id) {
        $investigador = Investigador::findOrFail($id);

        return view('gestion.revision', compact('investigador'));
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

    function mostrarDocumentoInvestigador($idInvestigador, $tabla, $idDocumento) {
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

        return view('gestion.revision-doc', compact('doc'));
    }
}
