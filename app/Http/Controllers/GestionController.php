<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use Illuminate\Http\Request;

class GestionController extends Controller
{
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
}
