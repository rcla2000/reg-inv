const eliminarUsuario = (boton, id) => {
    confirmacion('¿Está seguro/a que desea eliminar el registro de este usuario?', async () => {
        const peticion = await fetch(route('usuarios.eliminar'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                id_usuario: id
            })
        });

        const json = await peticion.json();

        if (peticion.status === 200) {
            // Se obtiene la fila del registro que se eliminó de la base de datos y se elimina del html
            const filaRegistro = boton.closest('tr');
            filaRegistro.remove();
            Swal.fire("Información", json.message, "success");
        } else {
            Swal.fire('Error', json.message, 'error');
        }
    });
}
