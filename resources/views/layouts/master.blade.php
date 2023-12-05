<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.styles')
    <title>CONACYT | @yield('titulo')</title>
</head>
<body>
    <div class="container-fluid p-0">
        @yield('contenido')
    </div>
    @include('layouts.scripts')
</body>
</html>