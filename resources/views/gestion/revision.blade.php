@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
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
            <div class="documentos">
                @forelse ($investigador->docs_grados_academicos as $doc)
                    <a href="{{ route('investigadores.documento.mostrar', [
                        'idInvestigador' => $investigador->id_investigador,
                        'tabla' => 'ga',
                        'idDocumento' => $doc->id_documento
                    ]) }}" class="enlace-doc">
                        <div class="doc">
                            <div class="icono">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <span>{{ $doc->tipo->descripcion }}</span>
                        </div>
                    </a>
                    @empty
                    <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
                @endforelse
            </div>
            <hr>
            <h2 class="mb-3">Datos de la participación científica y tecnológica</h2>
            <hr>
            <div class="documentos">
                @forelse ($investigador->docs_participacion_cyts as $doc)
                    <a href="{{ route('investigadores.documento.mostrar', [
                        'idInvestigador' => $investigador->id_investigador,
                        'tabla' => 'par',
                        'idDocumento' => $doc->id_documento
                    ]) }}" class="enlace-doc">
                        <div class="doc">
                            <div class="icono">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <span>{{ $doc->tipo->descripcion }}</span>
                        </div>
                    </a>
                    @empty
                    <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
                @endforelse
            </div>
            <hr>
            <h2 class="mb-3">Datos del desempeño científico</h2>
            <hr>
            <div class="documentos">
                @forelse ($investigador->docs_desempeno_cyts as $doc)
                    <a href="{{ route('investigadores.documento.mostrar', [
                        'idInvestigador' => $investigador->id_investigador,
                        'tabla' => 'des',
                        'idDocumento' => $doc->id_documento
                    ]) }}" class="enlace-doc">
                        <div class="doc">
                            <div class="icono">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <span>{{ $doc->tipo->descripcion }}</span>
                        </div>
                    </a>
                    @empty
                    <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
                @endforelse
            </div>
            <hr>
            <h2 class="mb-3">Publicaciones de investigación científica y tecnológica</h2>
            <hr>
            <div class="documentos">
                @forelse ($investigador->docs_publicaciones_cyts as $doc)
                    <a href="{{ route('investigadores.documento.mostrar', [
                        'idInvestigador' => $investigador->id_investigador,
                        'tabla' => 'pub',
                        'idDocumento' => $doc->id_documento
                    ]) }}" class="enlace-doc">
                        <div class="doc">
                            <div class="icono">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <span>{{ $doc->tipo->descripcion }}</span>
                        </div>
                    </a>
                    @empty
                    <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
                @endforelse
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Acciones</h3>
                        <hr>
                        <div class="p-3">
                            <input type="hidden" value="{{ $investigador->id_investigador }}" id="id-inv">
                            <h4 class="mb-3">Observaciones:</h4>
                            <div class="observaciones">
                                @if (count($investigador->observaciones) > 0)
                                    @for($i = 0; $i < count($investigador->observaciones); $i++)
                                        <div class="observacion" id="observacion-{{ $investigador->observaciones[$i]->id_observacion }}">
                                            <span>
                                                <b>{{ $documentos[$i]->tipo->descripcion }}:</b>
                                                {{ $investigador->observaciones[$i]->observacion }}
                                            </span>
                                            <i class="fa-solid fa-circle-xmark" onclick="eliminarObservacion({{ $investigador->observaciones[$i]->id_observacion }})"
                                                data-bs-toggle="tooltip" data-bs-title="Eliminar observación"></i>
                                        </div>
                                    @endfor
                                @else
                                    <span class="p-4 text-center text-danger"><b>NO POSEE</b></span>
                                @endif   
                            </div>
                            <hr class="mt-4">
                            <h4 class="mt-3 mb-3">Aprobar o denegar al investigador:</h4>
                            <a href="" class="btn btn-success me-3" id="aprobar-inv">
                                <i class="fa-solid fa-square-check me-1"></i>
                                Aprobar
                            </a>
                            <a href="" class="btn btn-danger me-3" id="denegar-inv">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Denegar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-12">
                <a href="{{ route('investigadores.inicio') }}" class="btn btn-primary">Volver al listado</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/confirmacion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/peticiones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/revision.js') }}"></script>
@endsection
