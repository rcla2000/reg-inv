@extends('layouts.master')

@section('titulo', 'Registro')



@section('contenido')
    <div class="contenedor">
        <form action="{{ route('registro.guardar') }}" method="POST" enctype="multipart/form-data" id="frm-investigador"
            class="frm-investigador">
            @csrf
            <input type="hidden" name="puntaje" id="puntaje">
            <div class="mis-tabs">
                <div class="mi-tab">
                    <div class="row">
                        <h1 class="text-center mb-4">Ingreso de información</h1>
                        <hr>
                        <h3 class="text-center">Datos personales</h3>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="dui" class="form-label">Número de identidad del solicitante:</label>
                            <input type="text" class="form-control @error('dui') is-invalid @enderror" id="dui"
                                name="dui" value="">
                            <div class="invalid-feedback">
                                @error('dui')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="primer-nombre" class="form-label">Primer nombre del solicitante:</label>
                            <input type="text" class="form-control @error('primer_nombre') is-invalid @enderror"
                                id="primer-nombre" name="primer_nombre" value="">
                            <div class="invalid-feedback">
                                @error('primer_nombre')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="segundo-nombre" class="form-label">Segundo nombre del solicitante:</label>
                            <input type="text" class="form-control @error('segundo_nombre') is-invalid @enderror"
                                id="segundo-nombre" name="segundo_nombre" value="">
                            <div class="invalid-feedback">
                                @error('segundo_nombre')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="primer-apellido" class="form-label">Primer apellido solicitante:</label>
                            <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror"
                                id="primer-apellido" name="primer_apellido" value="">
                            <div class="invalid-feedback">
                                @error('primer_apellido')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="segundo-apellido" class="form-label">Segundo apellido solicitante:</label>
                            <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror"
                                id="segundo-apellido" name="segundo_apellido" value="">
                            <div class="invalid-feedback">
                                @error('segundo_apellido')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h2 class="text-center">Datos de contacto</h2>
                        <h3 class="text-center">Dirección actual</h3>
                    </div>
                    <div class="row">
                        <div class="form-group mt-2 mb-3">
                            <label for="departamento" class="mb-2">Departamento y municipio: *</label>
                            <select class="form-select select2 @error('departamento') is-invalid @enderror"
                                id="departamento" name="departamento">
                                @foreach ($departamentos as $d)
                                    <option value="{{ $d->id_departamento }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                            <br>
                            <select class="form-select select2 @error('municipio') is-invalid @enderror" id="municipio"
                                name="municipio">
                            </select>
                        </div>

                        <div class="mt-2 mb-3">
                            <label for="direccion" class="mb-2">Datos que complementan la dirección: *</label>
                            <textarea 
                                class="form-control @error('direccion') is-invalid @enderror" 
                                id="direccion" name="direccion"></textarea>
                            <div class="invalid-feedback">
                                @error('direccion')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono: *</label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror"
                                id="telefono" name="telefono" value="">
                            <div class="invalid-feedback">
                                @error('telefono')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo para notificaciones: *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="">
                            <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email-confirmacion" class="form-label">Confirmar correo: *</label>
                            <input type="email" class="form-control @error('email_confirmacion') is-invalid @enderror"
                                id="email-confirmacion" name="email_confirmacion" value="">
                            <div class="invalid-feedback">
                                @error('email_confirmacion')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('bienvenida') }}" class="btn btn-primary me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <hr>
                        <h2 class="text-center">Datos del desarrollo académico</h2>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <p class="p-0">Grado académico: *</p>
                        @foreach ($gradosAcademicos as $g)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox"
                                    data-mostrar="seccion_{{ $g->id_grado }}" id="grado_ac_{{ $g->id_grado }}">
                                <label class="form-check-label" for="grado_ac_{{ $g->id_grado }}">
                                    {{ $g->nombre }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($gradosAcademicos as $g)
                        <div class="row mt-3 oculto" id="seccion_{{ $g->id_grado }}">
                            <hr>
                            <h3>Información de {{ $g->nombre }}s</h3>
                            <h6>Títulos {{ $g->nombre }}s: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary"
                                    for="archivos_ga_{{ $g->id_grado }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="GA|{{ $g->medicion }}" name="archivos_ga_{{ $g->id_grado }}[]"
                                    id="archivos_ga_{{ $g->id_grado }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $g->comentario_archivo }} (Máximo 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <hr>
                        <h2 class="text-center">Datos de la participación científica y tecnológica</h2>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="p-0">Participación en organizaciones y redes de CyT</h3>
                        <p class="p-0">Rol de participación en organizaciones, redes de CyT: (Opcional)</p>

                        @foreach ($participacion1 as $p)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox"
                                    data-mostrar="secc_part_{{ $p->id_concepto }}"
                                    id="participacion-{{ $p->id_concepto }}">
                                <label class="form-check-label" for="participacion-{{ $p->id_concepto }}">
                                    {{ $p->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($participacion1 as $p)
                        @php  $comentarios = explode('|', $p->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_part_{{ $p->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_part_{{ $p->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="PAR1|{{ $p->medicion }}" name="archivos_part_{{ $p->id_concepto }}[]"
                                    id="archivos_part_{{ $p->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <hr>
                        <h3 class="p-0">Participación en capacitaciones científicas, tecnológicas, creatividad o
                            innovación
                        </h3>
                        <p class="p-0">Rol de participación en capacitaciones científicas, tecnológicas e innovación:
                            (Opcional)</p>

                        @foreach ($participacion2 as $p)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox"
                                    id="participacion-{{ $p->id_concepto }}" data-mostrar="secc_part2_{{ $p->id_concepto }}">
                                <label class="form-check-label" for="participacion-{{ $p->id_concepto }}">
                                    {{ $p->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($participacion2 as $p)
                        @php  $comentarios = explode('|', $p->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_part2_{{ $p->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_part_{{ $p->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="PAR2|{{ $p->medicion }}" name="archivos_part_{{ $p->id_concepto }}[]"
                                    id="archivos_part_{{ $p->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <hr>
                        <h2 class="text-center">Datos de la participación en eventos científicos y tecnológicos</h2>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="p-0">Participación en congresos, simposios, seminarios, pósteres</h3>
                        <p class="p-0">Rol de participación en congresos, simposio, seminarios, pósteres: (Opcional)</p>

                        @foreach ($participacion3 as $p)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox"
                                    data-mostrar="secc_part3_{{ $p->id_concepto }}"
                                    id="participacion-{{ $p->id_concepto }}">
                                <label class="form-check-label" for="participacion-{{ $p->id_concepto }}">
                                    {{ $p->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($participacion3 as $p)
                        @php  $comentarios = explode('|', $p->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_part3_{{ $p->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_part_{{ $p->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="PAR3|{{ $p->medicion }}" name="archivos_part_{{ $p->id_concepto }}[]"
                                    id="archivos_part_{{ $p->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <hr>
                        <h2 class="text-center">Datos del desempeño científico</h2>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="p-0">Contribuciones</h3>
                        <p class="p-0">Contribuciones técnicas, productivas y/o innovadoras: (Opcional)</p>

                        @foreach ($desempeno1 as $d)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" 
                                    data-mostrar="secc_des1_{{ $d->id_concepto }}"
                                    type="checkbox" id="desempeno-{{ $d->id_concepto }}">
                                <label class="form-check-label" for="desempeno-{{ $d->id_concepto }}">
                                    {{ $d->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($desempeno1 as $d)
                        @php  $comentarios = explode('|', $d->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_des1_{{ $d->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_des_{{ $d->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="DES1|{{ $d->medicion }}" name="archivos_des_{{ $d->id_concepto }}[]"
                                    id="archivos_des_{{ $d->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <hr>
                        <h3 class="p-0">Rol de participación en proyectos CyT</h3>
                        <p class="p-0">Participación en proyectos CyT: (Opcional)</p>

                        @foreach ($desempeno2 as $d)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox" 
                                    data-mostrar="secc_des2_{{ $d->id_concepto }}"
                                    id="desempeno-{{ $d->id_concepto }}">
                                <label class="form-check-label" for="desempeno-{{ $d->id_concepto }}">
                                    {{ $d->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($desempeno2 as $d)
                        @php  $comentarios = explode('|', $d->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_des2_{{ $d->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_des_{{ $d->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="DES2|{{ $d->medicion }}" name="archivos_des_{{ $d->id_concepto }}[]"
                                    id="archivos_des_{{ $d->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <hr>
                        <h3 class="p-0">Financiamiento de investigación</h3>
                        <p class="p-0">Obtención de financiación externa a su investigación: (Opcional)</p>

                        @foreach ($desempeno3 as $d)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox" 
                                    data-mostrar="secc_des3_{{ $d->id_concepto }}"
                                    id="desempeno-{{ $d->id_concepto }}">
                                <label class="form-check-label" for="desempeno-{{ $d->id_concepto }}">
                                    {{ $d->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($desempeno3 as $d)
                        @php  $comentarios = explode('|', $d->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_des3_{{ $d->id_concepto }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_des_{{ $d->id_concepto }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="DES3|{{ $d->medicion }}" name="archivos_des_{{ $d->id_concepto }}[]"
                                    id="archivos_des_{{ $d->id_concepto }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <hr>
                        <h2 class="text-center">Datos del desempeño en publicaciones científicas y tecnológicas</h2>
                        <h6 class="text-center mb-4">Trámite nro: <b class="text-center">{{ $nTramite }}</b></h6>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="p-0">Publicaciones de investigación científica y tecnológica</h3>
                        <p class="p-0">Historial publicaciones de investigación científica y/o tecnológica: (Opcional)
                        </p>

                        @foreach ($publicaciones as $p)
                            <div class="form-check">
                                <input class="form-check-input chk-seccion" type="checkbox"
                                    data-mostrar="secc_public_{{ $p->id_publicacion }}"
                                    id="publicacion-{{ $p->id_publicacion }}">
                                <label class="form-check-label" for="publicacion-{{ $p->id_publicacion }}">
                                    {{ $p->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @foreach ($publicaciones as $p)
                        @php  $comentarios = explode('|', $p->comentario_archivo) @endphp 
                        <div class="row mt-3 oculto" id="secc_public_{{ $p->id_publicacion }}">
                            <hr>
                            <h6>{{ $comentarios[0] }}: *</h6>
                            <div class="col-12 mt-2">
                                <label class="btn btn-secondary" for="archivos_public_{{ $p->id_publicacion }}">
                                    <i class="fa-solid fa-upload me-2"></i>
                                    Subir archivo
                                </label>
                                <input type="file" multiple data-medicion="PUB|{{ $p->medicion }}" name="archivos_public_{{ $p->id_publicacion }}[]"
                                    id="archivos_public_{{ $p->id_publicacion }}" class="oculto">
                                <div class="invalid-feedback"></div>
                                <p class="mb-3 mt-2">{{ $comentarios[1] }} (Máximo tamaño del documento 10MB)</p>
                                <div class="listado-archivos"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <a href="#" class="btn btn-primary siguiente">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div class="mi-tab">
                    <div class="row">
                        <h2 class="text-center">Confirmación de envío de datos</h2>
                        <p>A continuación, se realizará el envío de datos para ser registrados por el sistema. El formulario
                            será enviado
                            a la siguiente etapa de "Revisión de información". Haz clic en <b>Continuar</b> para confirmar
                            el
                            envío.
                        </p>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary volver me-2">Volver</a>
                            <input type="submit" class="btn btn-primary" value="Continuar" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript" src="{{ asset('assets/js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
@endsection
