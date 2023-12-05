const contenedorTabs = document.querySelector('.mis-tabs');
const btnsSiguiente = document.querySelectorAll('.siguiente');
const btnsAtras = document.querySelectorAll('.volver');
const form = document.querySelector('#frm-investigador');
const puntaje = document.querySelector('#puntaje');
const dui = document.querySelector('#dui');
const primerNombre = document.querySelector('#primer-nombre');
const segundoNombre = document.querySelector('#segundo-nombre');
const primerApellido = document.querySelector('#primer-apellido');
const segundoApellido = document.querySelector('#segundo-apellido');
const departamento = document.querySelector('#departamento');
const municipio = document.querySelector('#municipio');
const direccion = document.querySelector('#direccion');
const telefono = document.querySelector('#telefono');
const email = document.querySelector('#email');
const emailConfirmacion = document.querySelector('#email-confirmacion');
const chksSecciones = document.querySelectorAll('.chk-seccion');

const formatoTelefono = {
    mask: '0000-0000'
};
const formatoDui = {
    mask: '00000000-0'
}

const obtenerMunicipios = async idDepartamento => {
    try {
        const peticion = await fetch(`/municipios/${idDepartamento}`);
        const data = peticion.json();
        return data;
    } catch (error) {
        console.error(error);
        return false;
    }
}

const htmlMunicipios = municipios => {
    let html = '';

    municipios.forEach(m => {
        html += `<option value="${m.id_municipio}">${m.nombre}</option>`;
    });
    
    return html;
}

const cargarMunicipiosEnSelect = async () => {
    const municipios = await obtenerMunicipios(departamento.value);
    const html = htmlMunicipios(municipios);
    municipio.innerHTML = html;
}

const validarInputsFile = () => {
    const inputsFile = document.querySelectorAll('input[data-habilitado="true"]');
    inputsFile.forEach(input => {
        if (input.files.length > 0 ) {
            for (let i = 0; i < input.files.length; i++) {
                if (!tipoArchivo(input.files[i]) || !tamanoMaximoArchivo(input.files[i])) {
                    agregarError(
                        input,
                        input.nextElementSibling,
                        'Solo se permiten archivos de tipo PDF y máximo de 10MB cada uno'
                    );
                    break;
                } else {
                    limpiarError(input, input.nextElementSibling);
                }
            }
        } else {
            agregarError(
                input,
                input.nextElementSibling,
                'Debe seleccionar al menos un archivo'
            );
        }
    });
}

const mostrarArchivosSeleccionadosInputFile = () => {
    const inputsFile = document.querySelectorAll('input[type="file"]');
    inputsFile.forEach(input => {
        input.addEventListener('change', e => {
            if (input.files.length > 0) {
                const div = document.querySelector(`#${e.target.id} ~ .listado-archivos`);
                let html = '<b>Archivos seleccionados:</b><ul>';
                for (let i = 0; i < input.files.length; i++) {
                    html += `<li>${input.files[i].name}</li>`;
                }
                html += '</ul>'
                div.innerHTML = html;
            }
        })
    });
}

const establecerNota = (nota, mayorNota) => {
    if (nota > mayorNota) 
        return mayorNota;
    return nota;
}

const calificacionInvestigador = () => {
    const inputsFile = document.querySelectorAll('input[data-habilitado="true"]');
    let notaGradoAcademico = 0,
        notaParticipacion1 = 0,
        notaParticipacion2 = 0,
        notaParticipacion3 = 0,
        notaDesempeno1 = 0,
        notaDesempeno2 = 0,
        notaDesempeno3 = 0,
        notaPublicaciones = 0,
        notaFinal = 0;
        medicion = '';
    
    inputsFile.forEach(input => {
        medicion = input.dataset.medicion.split('|');
        switch (medicion[0]) {
            case 'GA':
                notaGradoAcademico += parseInt(medicion[1]);
            break;
            case 'PAR1':
                notaParticipacion1 += parseInt(medicion[1]);
            break;
            case 'PAR2':
                notaParticipacion2 += parseInt(medicion[1]);
            break;
            case 'PAR3':
                notaParticipacion3 += parseInt(medicion[1]);
            break;
            case 'DES1':
                notaDesempeno1 += parseInt(medicion[1]);
            break;
            case 'DES2':
                notaDesempeno2 += parseInt(medicion[1]);
            break;
            case 'DES3':
                notaDesempeno3 += parseInt(medicion[1]);
            break;
            case 'PUB':
                notaPublicaciones += parseInt(medicion[1]);
            break;
        }
    });

    notaGradoAcademico = establecerNota(notaGradoAcademico, 20);
    notaParticipacion1 = establecerNota(notaParticipacion1, 10);
    notaParticipacion2 = establecerNota(notaParticipacion2, 10);
    notaParticipacion3 = establecerNota(notaParticipacion3, 10);
    notaDesempeno1 = establecerNota(notaDesempeno1, 15);
    notaDesempeno2 = establecerNota(notaDesempeno2, 10);
    notaDesempeno3 = establecerNota(notaDesempeno3, 10);
    notaPublicaciones = establecerNota(notaPublicaciones, 15);
    notaFinal = notaGradoAcademico + notaParticipacion1 + notaParticipacion2 + notaParticipacion3;
    notaFinal += notaDesempeno1 + notaDesempeno2 + notaDesempeno3 + notaPublicaciones;
    return notaFinal;
}

// Aplicando máscara a input de teléfono
IMask(telefono, formatoTelefono);
// Aplicando máscara a input de DUI
IMask(dui, formatoDui);

// Inicializando select con búsqueda
$('.select2').select2({
    theme: 'bootstrap-5'
});

// Se cargan los municipios por defecto según el departamento seleccionado
cargarMunicipiosEnSelect();
// Se cargan dinámicamente los municipios según el departamento seleccionado
$('#departamento').on('change', cargarMunicipiosEnSelect);

mostrarArchivosSeleccionadosInputFile();

// Validaciones para los inputs
validar(
    btnsSiguiente[0],
    dui,
    dui.nextElementSibling,
    [
        { validacion: 'vacio', mensaje: 'Ingrese su DUI' },
        { validacion: 'dui', mensaje: 'Ingrese un DUI válido. Formato: 00000000-0'}
    ]
);

validar(
    btnsSiguiente[0],
    primerNombre,
    primerNombre.nextElementSibling,
    { validacion: 'vacio', mensaje: 'Ingrese su primer nombre' }
);

validar(
    btnsSiguiente[0],
    segundoNombre,
    segundoNombre.nextElementSibling,
    { validacion: 'vacio', mensaje: 'Ingrese su segundo nombre' }
);

validar(
    btnsSiguiente[0],
    primerApellido,
    primerApellido.nextElementSibling,
    { validacion: 'vacio', mensaje: 'Ingrese su primer apellido' }
);

validar(
    btnsSiguiente[0],
    segundoApellido,
    segundoApellido.nextElementSibling,
    { validacion: 'vacio', mensaje: 'Ingrese su segundo apellido' }
);

validar(
    btnsSiguiente[0],
    direccion,
    direccion.nextElementSibling,
    { validacion: 'vacio', mensaje: 'Especifique una dirección' }
);

validar(
    btnsSiguiente[0],
    telefono,
    telefono.nextElementSibling,
    [
        { validacion: 'vacio', mensaje: 'Ingrese su segundo apellido' },
        { validacion: 'telefono', mensaje: 'Digite un número de teléfono válido. Debe comenzar con los números 2,6 o 7.' }
    ]
);

validar(
    btnsSiguiente[0],
    email,
    email.nextElementSibling,
    { validacion: 'email', mensaje: 'Ingrese un email válido' }
);

validar(
    btnsSiguiente[0],
    emailConfirmacion,
    emailConfirmacion.nextElementSibling,
    { validacion: 'email', mensaje: 'Ingrese un email válido' }
);


// Validando que los correos ingresados sean iguales
btnsSiguiente[0].addEventListener('click', () => {
    if (email.value != emailConfirmacion.value) {
        agregarError(
            emailConfirmacion, 
            emailConfirmacion.nextElementSibling,
            'Los correos electrónicos ingresados deben ser iguales'
        );
    } else {
        limpiarError(emailConfirmacion, emailConfirmacion.nextElementSibling);
    }
});

// Funcionalidad de los botones de atrás y siguiente de las secciones del formulario
for (let i = 0; i < btnsSiguiente.length; i++) {
    btnsSiguiente[i].addEventListener('click', e => {
        e.preventDefault();
        // Función para validar tipo y tamaño de los archivos de los inputs files
        validarInputsFile();
        if (totalErrores() == 0) {
            // Se realiza la animación para mostrar la siguiente sección del formulario
            contenedorTabs.style.transform = `translateX(-${((i+1) * (100 / contenedorTabs.childElementCount)).toFixed(2) }%)`; 
            // Llevando scroll hasta arriba de la página
            window.scrollTo(0, 0);
        } else {
            Swal.fire('Error', 'Complete correctamente toda la información requerida', 'error');
        }
    });
}

for (let i = 0; i < btnsAtras.length; i++) {
    btnsAtras[i].addEventListener('click', e => {
        e.preventDefault();
        contenedorTabs.style.transform = `translateX(-${(i * (100 / contenedorTabs.childElementCount)).toFixed(2) }%)`; 
         // Llevando scroll hasta arriba de la página
        window.scrollTo(0, 0);
    });
}

// Funcionalidad para mostrar secciones segun los checkbox accionados
chksSecciones.forEach(chk => {
    chk.addEventListener('click', () => {
        const seccion =  document.getElementById(chk.dataset.mostrar);
        const inputFile = document.querySelector(`#${chk.dataset.mostrar} input[type="file"]`);
        if (chk.checked) {
            seccion.classList.remove('oculto');
            inputFile.dataset.habilitado = true;
            inputFile.removeAttribute('disabled');
        } else {
            seccion.classList.add('oculto');
            inputFile.dataset.habilitado = false;
            inputFile.setAttribute('disabled', true);
            limpiarError(inputFile, inputFile.nextElementSibling);
        }
    });
});

form.addEventListener('submit', e => {
    e.preventDefault();
   
    if (totalErrores() == 0) {
        const calificacion = calificacionInvestigador();
        if (calificacion >= 50) {
            // Se guarda en el input hidden la calificacion obtenida para enviarla al servidor
            puntaje.value = calificacion;
            form.submit();
        } else {
            let mensajeError = 'Su registro no puede ser completado. Debe agregar más documentos sobre su grado académico,';
                mensajeError += ' historial de publicaciones de investigación científica, contribuciones técnicas productivas y/o';
                mensajeError += ' innvadoras, roles de participación en proyectos CyT, historial de congresos, simposios, seminarios,';
                mensajeError += ' pósteres, capacitaciones científicas, tecnológicas, creatividad o innovación.';

            Swal.fire('Error', mensajeError, 'error'); 
        }
    } else {
        Swal.fire('Error', 'Se han encontrado errores, debe solucionarlos para que sus datos sean enviados', 'error');
    }
});
