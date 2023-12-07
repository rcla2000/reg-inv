<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DesempenoCyt;
use App\Models\DocsDesempenoCyt;
use App\Models\DocsGradosAcademico;
use App\Models\DocsParticipacionCyt;
use App\Models\DocsPublicacionesCyt;
use App\Models\GradosAcademico;
use App\Models\Investigador;
use App\Models\Municipio;
use App\Models\ParticipacionCyt;
use App\Models\PublicacionesCyt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RegistroController extends Controller
{
    function inicio() {
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        $gradosAcademicos = GradosAcademico::where('id_grado', '>', 0)->get();
        $participacion1 = ParticipacionCyt::where('padre', 1)->get();
        $participacion2 = ParticipacionCyt::where('padre', 2)->get();
        $participacion3 = ParticipacionCyt::where('padre', 3)->get();
        $desempeno1 = DesempenoCyt::where('padre', 1)->get();
        $desempeno2 = DesempenoCyt::where('padre', 2)->get();
        $desempeno3 = DesempenoCyt::where('padre', 3)->get();
        $publicaciones = PublicacionesCyt::where('id_publicacion', '>', 0)->get();
        $nTramite = DB::select("SELECT `AUTO_INCREMENT` as tramite FROM INFORMATION_SCHEMA.TABLES
                                WHERE TABLE_SCHEMA = 'investigadores_cyt'
                                AND TABLE_NAME = 'investigadores';")[0]->tramite + 1;

        return view(
            'registro', 
            compact(
                'departamentos', 
                'municipios',
                'gradosAcademicos',
                'participacion1',
                'participacion2',
                'participacion3',
                'desempeno1',
                'desempeno2',
                'desempeno3',
                'publicaciones',
                'nTramite'
            )
        );
    }

    function listarMunicipios($idDepartamento) {
        $municipios = Municipio::where('id_departamento', $idDepartamento)->get();
        return $municipios;
    }

    private function validacionesArchivo($archivo) {
        if (strtolower($archivo->extension()) != 'pdf') {
            throw new Exception('Solo se permiten archivos de tipo PDF');
        }
        if (filesize($archivo) > 10485760) {
            throw new Exception('El tamaño máximo permitido del archivo es 10MB');
        }
    }

    private function guardarArchivosInvestigador($listaIds, $request, $nameInputs, $objeto, $investigador, $prefijo) {
        foreach ($listaIds as $id) {
            // Verificamos si los input file contienen archivos
            if ($request->hasFile($nameInputs . $id->id)) {
                /* Si tienen archivos recorremos cada uno se crea un nuevo registro en la base de datos
                    se valida el archivo, se guarda en el servidor y se almacena la información en la tabla
                    de la bdd
                */
                $archivos = $request->file($nameInputs . $id->id);
                foreach ($archivos as $archivo) {
                    // Validando archivo
                    $this->validacionesArchivo($archivo);
                   
                    $documento = new $objeto();
                    $documento->id_tipo = $id->id;
                    $documento->id_investigador = $investigador->id_investigador;
                    // Se almacena el archivo en el servidor
                    $rutaArchivo = $archivo->storeAs(
                        'investigadores/' . $investigador->id_investigador, 
                        $prefijo . '_' . $id->id . '_' . $investigador->id_investigador . '.' . $archivo->extension()
                    );
                    $documento->archivo = $rutaArchivo;
                    $documento->save();
                }
            }
        }

    }

    function calificacionesMaximasEstablecidas() {
        // Calificaciones máximas de cada apartado
        $gradoAcademico = GradosAcademico::select('medicion')->where('id_grado', 0)->first()->medicion;
        $participaciones = ParticipacionCyt::select('medicion')->where('padre', null)->get();
        $desempenos = DesempenoCyt::select('medicion')->where('padre', null)->get();
        $publicaciones = PublicacionesCyt::select('medicion')->where('id_publicacion', 0)->first()->medicion;

        return [
            'gradoAcademico' => $gradoAcademico,
            'participacion1' => $participaciones[0]->medicion,
            'participacion2' => $participaciones[1]->medicion,
            'participacion3' => $participaciones[2]->medicion,
            'desempeno1' => $desempenos[0]->medicion,
            'desempeno2' => $desempenos[1]->medicion,
            'desempeno3' => $desempenos[2]->medicion,
            'publicaciones' => $publicaciones
        ];
    }

    function guardarInvestigador(Request $request) {
        $request->validate([
            'dui' => 'required|string|regex:/^[0-9]{8}-[0-9]$/',
            'primer_nombre' => 'required|string',
            'segundo_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'required|string',
            'departamento' => 'required',
            'municipio' => 'required',
            'direccion' => 'required|string',
            'telefono' => 'required|string|regex:/^[267][0-9]{3}-[0-9]{4}$/',
            'email' => 'required|email',
            'email_confirmacion' => 'required|email',
            'puntaje' => 'required'
        ]);

        try {
            DB::beginTransaction();

            // Guardando datos en tabla investigador
            $investigador = new Investigador();
            $investigador->dui = $request->dui;
            $investigador->primer_nombre = $request->primer_nombre;
            $investigador->segundo_nombre = $request->segundo_nombre;
            $investigador->primer_apellido = $request->primer_apellido;
            $investigador->segundo_apellido = $request->segundo_apellido;
            $investigador->id_departamento = $request->departamento;
            $investigador->id_municipio = $request->municipio;
            $investigador->direccion = $request->direccion;
            $investigador->telefono = $request->telefono;
            $investigador->email = $request->email_confirmacion;
            $investigador->puntaje = $request->puntaje;
            $investigador->id_estado = 1;
            $investigador->save();

            // Se obtienen los id de los grados academicos para recorrer todos los name de los input file de grados academicos
            $idsGradosAcademicos = GradosAcademico::select('id_grado as id')->where('id_grado', '>', 0)->get();

            $this->guardarArchivosInvestigador(
                $idsGradosAcademicos,
                $request,
                'archivos_ga_',
                DocsGradosAcademico::class,
                $investigador,
                'GA'
            );

            $participaciones = ParticipacionCyt::select('id_concepto as id')->whereNot('padre', null)->get();

            $this->guardarArchivosInvestigador(
                $participaciones,
                $request,
                'archivos_part_',
                DocsParticipacionCyt::class,
                $investigador,
                'PAR'
            );

            $desempenos = DesempenoCyt::select('id_concepto as id')->whereNot('padre', null)->get();

            $this->guardarArchivosInvestigador(
                $desempenos,
                $request,
                'archivos_des_',
                DocsDesempenoCyt::class,
                $investigador,
                'DES'
            );
            
            $publicaciones = PublicacionesCyt::select('id_publicacion as id')->where('id_publicacion', '>', 0)->get();

            $this->guardarArchivosInvestigador(
                $publicaciones,
                $request,
                'archivos_public_',
                DocsPublicacionesCyt::class,
                $investigador,
                'PUB'
            );
           
            DB::commit();
            Alert::success('Información', 'Sus datos han sido almacenados correctamente. Recibirá una notificación vía correo electrónico dentro de 10 días hábiles sobre su trámite de registro.');
        } catch(Exception $e) {
            DB::rollBack();
            Alert::error('Ha ocurrido un error', $e->getMessage());
        } finally {
            return back();
        }
    }
}
