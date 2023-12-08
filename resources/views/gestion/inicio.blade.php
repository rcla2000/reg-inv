@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
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
                                <td>{{ $investigador->primer_nombre . ' ' . $investigador->segundo_nombre . ' ' . $investigador->primer_apellido . ' ' . $investigador->segundo_apellido }}</td>
                                <td>{{ $investigador->dui }}</td>
                                <td>{{ $investigador->email }}</td>
                                <td>{{ $investigador->telefono }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('investigadores.mostrar', $investigador->id_investigador) }}" 
                                        class="btn btn-sm btn-success">
                                        Revisión
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
