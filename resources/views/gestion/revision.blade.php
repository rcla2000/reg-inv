@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    <div class="p-3 w-100">
        <div class="row">
            <h1 class="text-center">Revisión de investigador</h1>
        </div>
        <hr>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Apartado</th>
                        <th>Información</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{ $investigador->primer_nombre . ' ' . $investigador->segundo_nombre . ' ' . $investigador->primer_apellido . ' ' . $investigador->segundo_apellido }}
                            </td>
                        </tr>
                        <tr>
                            <td>DUI: </td>
                            <td>{{ $investigador->dui }}</td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td>{{ $investigador->email }}</td>
                        </tr>
                        <tr>
                            <td>Teléfono: </td>
                            <td>{{ $investigador->telefono }}</td>
                        </tr>
                        <tr>
                            <td>Departamento: </td>
                            <td>{{ $investigador->departamento->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Municipio: </td>
                            <td>{{ $investigador->municipio->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Dirección: </td>
                            <td>{{ $investigador->direccion }}</td>
                        </tr>
                        <tr>
                            <td>Estado: </td>
                            <td>{{ $investigador->estados_investigador->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Calificación obtenida: </td>
                            <td>{{ $investigador->puntaje }}</td>
                        </tr>
                        <tr>
                            <td>Categoría según calificación: </td>
                            <td>{{ $investigador->categoria->categoria }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <hr>
            <h2 class="mb-3">Información sobre grados académicos</h2>
            <hr>
            @if (count($investigador->docs_grados_academicos) > 0)
                <div class="documentos">
                    @foreach ($investigador->docs_grados_academicos as $doc)
                        <a href="" class="enlace-doc">
                            <div class="doc">
                                <div class="icono">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <span>{{ $doc->grados_academico->nombre }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
            @endif
            <hr>
            <h2 class="mb-3">Datos de la participación científica y tecnológica</h2>
            <hr>
            @if (count($investigador->docs_participacion_cyts) > 0)
                <div class="documentos">
                    @foreach ($investigador->docs_participacion_cyts as $doc)
                        <a href="" class="enlace-doc">
                            <div class="doc">
                                <div class="icono">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <span>{{ $doc->participacion_cyt->descripcion }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
            @endif
            <hr>
            <h2 class="mb-3">Datos del desempeño científico</h2>
            <hr>
            @if (count($investigador->docs_desempeno_cyts) > 0)
                <div class="documentos">
                    @foreach ($investigador->docs_desempeno_cyts as $doc)
                        <a href="" class="enlace-doc">
                            <div class="doc">
                                <div class="icono">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <span>{{ $doc->desempeno_cyt->descripcion }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
            @endif
            <hr>
            <h2 class="mb-3">Publicaciones de investigación científica y tecnológica</h2>
            <hr>
            @if (count($investigador->docs_publicaciones_cyts) > 0)
                <div class="documentos">
                    @foreach ($investigador->docs_publicaciones_cyts as $doc)
                        <a href="" class="enlace-doc">
                            <div class="doc">
                                <div class="icono">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <span>{{ $doc->publicaciones_cyt->descripcion }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <a href="{{ route('investigadores.inicio') }}" class="btn btn-primary">Volver al listado</a>
            </div>
        </div>
    </div>
@endsection
