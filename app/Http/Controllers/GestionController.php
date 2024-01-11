<?php

namespace App\Http\Controllers;

use App\Models\DocsDesempenoCyt;
use App\Models\DocsGradosAcademico;
use App\Models\DocsParticipacionCyt;
use App\Models\DocsPublicacionesCyt;
use App\Models\Investigador;
use App\Models\Observacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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

    private function obtenerFechaActual() {
        $dia = date('d');
        $anio = date('Y');
        $mes = date('m');
        $meses = [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre'
        ];

        return [
            'dia' => $dia,
            'mes' => $meses[$mes - 1],
            'anio' => $anio
        ];
    }

    function emitirConstancia(Request $request) {
        try {
            $investigador = Investigador::findOrFail($request->id_investigador);
            $fechaActual = $this->obtenerFechaActual();
            $pdf = Pdf::loadView('gestion.constancia', compact('investigador', 'fechaActual'));
            $investigador->id_estado = 3;
            $investigador->save();
            return $pdf->download('constancia.pdf');
        } catch (Exception) {
            Alert::error('Error', 'No se pudo emitir la constancia');
            return back();
        }
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
            } catch (Exception) {
                return response()->json(['message' => 'Ha ocurrido un error al actualizar el estado del investigador'], 500);
            }
        }
        return response()->json(['message' => 'No se encontró el registro del investigador'], 400);
    }

    function eliminarInvestigador(Request $request) {
        try {
            DB::beginTransaction();
            Observacion::where('id_investigador', $request->idInvestigador)->delete();
            DocsGradosAcademico::where('id_investigador', $request->idInvestigador)->delete();
            DocsDesempenoCyt::where('id_investigador', $request->idInvestigador)->delete();
            DocsParticipacionCyt::where('id_investigador', $request->idInvestigador)->delete();
            DocsPublicacionesCyt::where('id_investigador', $request->idInvestigador)->delete();
            Investigador::destroy($request->idInvestigador);
            Storage::deleteDirectory("investigadores/$request->idInvestigador");
            DB::commit();
            return response()->json(['message' => 'El registro de investigador ha sido eliminado exitosamente']);
        } catch (Exception) {
            DB::rollBack();
            return response()->json(['message' => 'Ocurrió un error el intentar eliminar el registro'], 500);
        }
    }
}
