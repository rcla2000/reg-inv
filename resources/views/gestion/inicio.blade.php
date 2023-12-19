@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="p-3 w-100">
        <div class="row">
            <h1 class="text-center">Resolución</h1>
        </div>
        <hr>
        <div class="row mt-4">
            {{ $investigadores->onEachSide(5)->links() }}
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <th>Nombre</th>
                        <th>DUI</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th class="text-center">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($investigadores as $investigador)
                            <tr>
                                <td>{{ $investigador->primer_nombre . ' ' . $investigador->segundo_nombre . ' ' . $investigador->primer_apellido . ' ' . $investigador->segundo_apellido }}
                                </td>
                                <td>{{ $investigador->dui }}</td>
                                <td>{{ $investigador->email }}</td>
                                <td>{{ $investigador->telefono }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('investigadores.mostrar', $investigador->id_investigador) }}"
                                        class="btn btn-sm btn-success me-1" data-bs-toggle="tooltip"
                                        data-bs-title="Revisar documentación de investigador">
                                        Revisión
                                    </a>
                                    <a onclick="eliminarInvestigador()" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-title="Eliminar investigador">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $investigadores->onEachSide(5)->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/eliminar-inv.js') }}"></script>
@endsection
