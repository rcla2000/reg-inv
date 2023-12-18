@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
        <div class="row">
            <iframe src="{{ asset("/laraview/#../../storage/$doc->archivo") }}" 
                class="visor-pdf"></iframe>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <form method="POST" action="{{ route('documentos.observaciones.agregar') }}">
                    @csrf
                    <input type="hidden" name="tabla" value="{{ $tabla }}">
                    <input type="hidden" name="id_investigador" value="{{ $investigador->id_investigador }}">
                    <input type="hidden" name="id_documento" value="{{ $doc->id_documento }}">
                    @include('components.agregar-observacion')
                </form>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-12">
                <a href="{{ route('investigadores.mostrar', $investigador->id_investigador) }}"
                    class="btn btn-primary">
                    Volver
                </a>
            </div>
        </div>
    </div>
@endsection