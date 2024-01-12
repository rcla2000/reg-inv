@extends('layouts.master')

@section('titulo', 'Usuarios registrados')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="p-3 w-100">
        <div class="row">
            <h1 class="text-center">Usuarios registrados en el sistema</h1>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus me-1"></i>
                    Agregar usuario
                </a>
            </div>
        </div>
        <div class="row mt-4">
            {{ $usuarios->onEachSide(5)->links() }}
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Tipo de usuario</th>
                        <th>Email</th>
                        <th class="text-center">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->username}}</td>
                                <td>{{ $usuario->tipo_usuario->nombre }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('usuarios.editar.get', $usuario->id) }}"
                                        class="btn btn-sm btn-warning me-2" data-bs-toggle="tooltip"
                                        data-bs-title="Editar información de usuario">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>
                                        Editar
                                    </a>
                                    <a href="{{ route('usuarios.password.reestablecer.get', $usuario->id) }}"
                                        class="btn btn-sm btn-success me-2" data-bs-toggle="tooltip"
                                        data-bs-title="Reestablecer la contraseña de este usuario">
                                        <i class="fa-solid fa-key me-1"></i>
                                        Reestablecer contraseña
                                    </a>
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-title="Eliminar usuario del sistema"
                                        onclick="eliminarUsuario(this, {{ $usuario->id }})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $usuarios->onEachSide(5)->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/confirmacion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gestiones/eliminar-usuario.js') }}"></script>
@endsection
