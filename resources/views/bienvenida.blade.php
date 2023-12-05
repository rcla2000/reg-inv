@extends('layouts.master')

@section('titulo', 'Bienvenido Investigador/a')

@section('contenido')
    <div class="p-4 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <h1 class="text-center p-4">Regístrate como investigador científico</h1>
            <hr>
            <div class="col-12 text-center">
                <a href="{{ route('registro.inicio') }}" class="btn btn-primary btn-large mt-3 btn-registro">
                    Iniciar trámite
                    <i class="fa-solid fa-hand-pointer ms-2"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
