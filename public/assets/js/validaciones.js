const estaVacio = valor => {
    if (valor === undefined || valor === null || valor.trim().length == 0) {
        return true;
    }
    return false;
}

const fechaCorrecta = fecha => {
    const regex = new RegExp('^[0-9]{2}/[0-9]{2}/[0-9]{4}$');
    return regex.test(fecha);
}

const duiCorrecto = dui => {
    const regex = new RegExp('^[0-9]{8}-[0-9]$');
    return !regex.test(dui);
}

const telefonoSvCorrecto = telefono => {
    const regex = new RegExp('^[267][0-9]{3}-[0-9]{4}$');
    return !regex.test(telefono);
}

const emailCorrecto = (email) => {
    const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return !regex.test(email);
}

const soloLetras = e => {
    const regex = /^[a-zA-Z\u00C0-\u017F\s]+$/;
    const key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!regex.test(key)) {
        e.preventDefault();
        return false;
    }
}

const soloNumeros = e => {
    const code = (e.which) ? e.which : e.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        e.preventDefault();
        return false;
    }
}

const tamanoMaximoArchivo = archivo => {
    // Tamaño maximo 10MB
    const maximo = 10485760;

    if (archivo.size > maximo) {
        return false;
    }
    return true;
}

const tipoArchivo = archivo => {
    const extensionesPermitidas = /^(pdf)$/,
        extension = archivo.name.substring(archivo.name.lastIndexOf('.') + 1).toLowerCase(),
        tipoArchivo = archivo.type.substring(archivo.type.lastIndexOf('/') + 1).toLowerCase();

    if (extension == tipoArchivo) {
        return extensionesPermitidas.test(tipoArchivo);
    }   
    return false;
}

const agregarError = (elemento, elementoMensaje, mensaje) => {
    elemento.classList.add("is-invalid");
    elementoMensaje.textContent = mensaje;
};

const limpiarError = (elemento, elementoMensaje) => {
    elemento.classList.remove("is-invalid");
    elementoMensaje.textContent = "";
};

const totalErrores = () => {
    const errores = document.querySelectorAll('.is-invalid').length;
    return errores;
}

const mostrarMensaje = (funcion, elemento, elementoMensaje, mensaje) => {
    if (funcion(elemento.value)) {
        agregarError(elemento, elementoMensaje, mensaje);
    } else {
        limpiarError(elemento, elementoMensaje);
    }
}

const asignarValidacion = (formulario, elemento, elementoMensaje, validaciones) => {
    let funcion = null;
    switch(validaciones.validacion) {
        case 'vacio':
            funcion = estaVacio;
        break;
        case 'dui':
            funcion = duiCorrecto;
        break;
        case 'telefono':
            funcion = telefonoSvCorrecto;
        break;
        case 'email':
            funcion = emailCorrecto;
        break;
    }
    formulario.addEventListener('click', e => {
        e.preventDefault();
        mostrarMensaje(funcion, elemento, elementoMensaje, validaciones.mensaje);
    });
    elemento.addEventListener('input', () => {
        mostrarMensaje(funcion, elemento, elementoMensaje, validaciones.mensaje);
    });
    elemento.addEventListener('blur', () => {
        mostrarMensaje(funcion, elemento, elementoMensaje, validaciones.mensaje);
    });
}

const validar = (formulario, elemento, elementoMensaje, validaciones) => {
    if (Array.isArray(validaciones)) {
        validaciones.forEach(validacion => {
            asignarValidacion(formulario, elemento, elementoMensaje, validacion);
        });
    } else {
        asignarValidacion(formulario, elemento, elementoMensaje, validaciones);
    }
}

