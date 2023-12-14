@extends('layouts.master')

@section('titulo', 'Visor PDF')

@section('contenido')
    <div class="controls">
        <button id="previous" class="previous">&laquo; Previous</button>
        <p id="pageNumber">Page 1 of 1</p>
        <button id="next" class="next">Next &raquo;</button>
    </div>

    <canvas id="canvas"></canvas>

@endsection

@section('scripts')
    <script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
    <script type="module" src="{{ asset('assets/js/visor-pdf.mjs') }}"></script>
@endsection
