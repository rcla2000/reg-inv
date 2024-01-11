const btnDenegar = document.querySelector('#denegar-inv');
const idInvestigador = document.querySelector('#id-inv').value;
const token = document.getElementsByTagName('meta')['csrf-token'].content;
const contenedorObservaciones = document.querySelector('.observaciones');
const frmAprobarInvestigador = document.querySelector('#frm-aprobar-inv');

const actualizarEstadoInvestigador = async (idInvestigador, idEstado) => {
    try {
        const peticion = await fetch(route('investigador.estado.actualizar'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            method: 'POST',
            body: JSON.stringify({
                idInvestigador: idInvestigador,
                idEstado: idEstado
            })
        });
    
        if (peticion.status === 200) {
            const data = await peticion.json();
            return data;
        }
        return false;
    } catch(error) {
        console.error(error);
        return false;
    }
}

frmAprobarInvestigador.addEventListener('submit', async e => {
    e.preventDefault();

    confirmacion('¿Está seguro/a que desea APROBAR al/la investigador/a?', () => {
        frmAprobarInvestigador.submit();
    });
});

btnDenegar.addEventListener('click', async e => {
    e.preventDefault();

    confirmacion('¿Está seguro/a que desea DENEGAR al/la investigador/a?', async () => {
        const res = await actualizarEstadoInvestigador(idInvestigador, 4);
            res ?
                Swal.fire('Información', res.message, 'success')
                :
                Swal.fire('Error', 'Ocurrió un error al actualizar el estado del investigador', 'error');
    });
});

const eliminarObservacion = idObservacion => {
    confirmacion('¿Está seguro/a que desea eliminar esta observación?', async () => {
        const res = await peticion(
            route('documentos.observaciones.eliminar'), 
            'POST',
            token,
            {
                id_observacion: idObservacion
            }
        );
        
        if (res.status === 200) {
            contenedorObservaciones.removeChild(document.getElementById(`observacion-${idObservacion}`));
            Swal.fire('Información', res.json.message, 'success');
        } else {
            Swal.fire('Error', res.json.message, 'error');
        }
    });
}
