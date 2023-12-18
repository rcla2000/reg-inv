@extends('layouts.master')

@section('titulo', 'Registro')

@section('contenido')
    @include('components.navbar')
    <div class="espacio-menu"></div>
    <div class="container pt-4">
        <h1>Hola mundo</h1>
        <h6>El documento es: {{ asset("storage/$doc->archivo") }}</h6>
    </div>
@endsection