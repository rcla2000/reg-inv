@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
        <div class="row">
            <h2 class="mb-4">Reestablecer contraseña de: {{ $usuario->name }}</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <form method="POST" action="{{ route('usuarios.password.reestablecer.post') }}">
                    @csrf
                    <input type="hidden" name="id_usuario" value={{ $usuario->id }}>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva contraseña:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        <div class="invalid-feedback">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password-2" class="form-label">Confirmar contraseña:</label>
                        <input type="password" class="form-control @error('password_2') is-invalid @enderror" id="password-2"
                            name="password_2">
                        <div class="invalid-feedback">
                            @error('password_2')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger me-2">
                        <i class="fa-solid fa-key me-1"></i>
                        Reestablecer contraseña
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