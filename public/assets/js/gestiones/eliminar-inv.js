const eliminarInvestigador = idInvestigador => {
    confirmacion('¿Está seguro/a que desea eliminar este investigador/a?', async () => {
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
    });
}
