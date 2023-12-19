const eliminarInvestigador = idInvestigador => {
    Swal.fire({
        title: "¿Está seguro/a que desea eliminar este investigador/a?",
        showDenyButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const peticion = await fetch('/gestion/investigadores/eliminar', {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
                },
                method: 'POST',
                body: JSON.stringify({
                    idInvestigador: idInvestigador,
                })
            });
        
            if (peticion.status === 200) {
                const json = await peticion.json();
                Swal.fire("Información", json.message, "success");
            } else {
                Swal.fire('Error', 'No se pudo eliminar el registro de investigador', 'error');
            }
        } else if (result.isDenied) {
            Swal.fire("Operación cancelada", "", "info");
        }
    });
};
