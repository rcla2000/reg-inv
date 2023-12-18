<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancia</title>
</head>

<style>
    .contenedor-constancia {
        padding: 0 2.5rem;
    }

    p,
    span {
        font-size: 1.6rem;
    }

    .constancia {
        font-size: 1.4rem;
        font-weight: 600
    }

    span.nombre {
        font-weight: 700;
        font-size: 2rem;
    }

    .seccion-firma {
        width: 400px;
        margin: 2.5rem auto;
    }

    .contenedor-autentica {
        position: relative;
    }

    div.nombre {
        width: 65%;
        border-top: solid 2px #000;
        margin: 0 auto;
    }

    .firma {
        width: 100px;
        left: 8.9rem;
        position: relative;
        top: 1.8rem;
    }

    .sello {
        width: 200px;
        position: absolute;
        right: -8rem;
        top: -0.2rem;
    }

    .pie p {
        font-size: 0.8rem;
    }

    .mt-6 {
        margin-top: 6rem;
    }

    .texto-azul-1 {
        color: #4c6494 !important;
    }

    .texto-azul-2 {
        color: #0c2968 !important;
    }

    .texto-negro {
        color: #000 !important;
    }

    .linea {
        margin: 0 !important;
        border: none;
        height: 1px !important;
        background-color: #000 !important;
        opacity: 1 !important;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-end {
        justify-content: flex-end !important;
    }

    .text-center {
        text-align: center !important;
    }

    .p-0 {
        padding: 0 !important;
    }

    .m-0 {
        margin: 0 !important;
    }

    .mt-1 {
        margin-top: 0.25rem !important;
    }

    .mt-2 {
        margin-top: 0.5rem !important;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .p-relative {
        position: !important;
    }

    .p-absolute {
        position: absolute !important;
    }

    .r-0 {
        right: 0 !important;
    }

    .l-0 {
        left: 0 !important;
    }

    .b-0 {
        bottom: 0 !important;
    }

    .mb-4rem {
        margin-bottom: 4rem;
    }

    .mr-1-5 {
        margin-right: 1.5rem;
    }

    .logos {
        width: 800px;
        opacity: 1;
    }

    .fondo {
        position: absolute;
        top: 5.5rem;
        right: 0;
        width: 100%;
    }

    .w-100 {
        width: 100%;
    }
</style>

<body>
    <img src="{{ public_path('assets/img/constancia/fondo.png') }}" alt="Fondo Logo Gobierno de El Salvador"
        title="Fondo Logo Gobierno de El Salvador" class="fondo">
    <section class="contenedor-constancia">
        <div class="mb-4 text-center">
            <img src="{{ public_path('assets/img/constancia/logos.png') }}" alt="Logos CONACYT y MINED"
                title="Logos CONACYT y MINED" class="logos">
        </div>
        <div class="p-relative mb-4rem">
            <span class="constancia p-absolute r-0 mr-1-5">CONSTANCIA</span>
        </div>
        <p>El Consejo Nacional de Ciencia y Tecnología, por este
            medio hace constar que</p>
        <div>
            <span class="nombre">
                Evelyn Haydeé García Rivas de Medina
            </span>
            <p class="mt-2">
                Con el código de identificación número <u>1412-190723</u>,
                forma parte de la Red de Investigadores en Ciencia y
                Tecnología de El Salvador, activo en la base de datos
                REDISAL.
            </p>
            <p>
                Y a solicitud del investigador, se extiende esta
                Constancia; válida por un año.
            </p>
            <p class="mt-5">
                Dado en la Ciudad de San Salvador, a los 19 días, del mes julio de 2023.
            </p>
        </div>
        <div class="seccion-firma">
            <div class="contenedor-autentica">
                <img src="{{ public_path('assets/img/constancia/firma.png') }}" alt="Firma Directora Ejecutiva"
                    title="Firma Directora Ejecutiva" class="firma">
                <img src="{{ public_path('assets/img/constancia/sello.png') }}" alt="Sello CONACYT"
                    title="Sello CONACYT" class="sello">
            </div>
            <div class="nombre">
                <p class="text-center p-0 m-0">Ing. Ana Teresa Vargas</p>
                <p class="text-center p-0 m-0">Directora Ejecutiva</p>
            </div>
        </div>
        <div class="p-absolute b-0 l-0 w-100">
            <hr class="linea">
            <div class="pie">
                <p class="text-center p-0 m-0 texto-azul-1">Col. Médica, Ave. Dr. Emilio Álvarez, Pasaje Dr. Guillermo
                    Rodríguez Pacas #51, San Salvador, El Salvador, C.A</p>
                <p class="text-center p-0 m-0 texto-azul-2">Apartado Postal 3103, Tel. (503) 2234-8400,
                    http//www.conacyt.gob.sv</p>
            </div>
        </div>
    </section>
</body>

</html>
