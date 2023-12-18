@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
        <iframe src="{{ asset("/laraview/#../../storage/$doc->archivo") }}" 
            class="visor-pdf"></iframe>
    </div>
@endsection