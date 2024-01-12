@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
        <div class="row">
            <h2 class="mb-4">Editar información de: {{ $usuario->name }}</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <form method="POST" action="{{ route('usuarios.editar.post') }}">
                    @csrf
                    <input type="hidden" name="id_usuario" value={{ $usuario->id }}>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $usuario->name }}">
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario:</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ $usuario->username }}">
                        <div class="invalid-feedback">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $usuario->email }}">
                        <div class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2 mb-3">
                        <label for="user_type" class="mb-2">Tipo de usuario:</label>
                        <select class="form-select @error('user_type') is-invalid @enderror"
                            id="user_type" name="user_type">
                            @foreach ($tiposUsuarios as $tipo)
                                <option value="{{ $tipo->id_tipo }}" @if($tipo->id_tipo == $usuario->user_type) selected @endif>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('user_type')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger me-2">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Actualizar
                    </button>
                    <a href="{{ route('usuarios.listar') }}" class="btn btn-primary">
                        <i class="fa-solid fa-left-long me-1"></i>
                        Volver
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection