const confirmacion = (pregunta, funcion) => {
    Swal.fire({
        title: pregunta,
        showDenyButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            funcion();
        } else if (result.isDenied) {
            Swal.fire("Operación cancelada", "", "info");
        }
    });
}