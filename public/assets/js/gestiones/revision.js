const btnAprobar = document.querySelector('#aprobar-inv');
const btnDenegar = document.querySelector('#denegar-inv');
const idInvestigador = document.querySelector('#id-inv').value;

const actualizaEstadoInvestigador = async (idInvestigador, idEstado) => {
    try {
        const peticion = await fetch('/gestion/investigadores/actualizar-estado', {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
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

btnAprobar.addEventListener('click', async e => {
    e.preventDefault();
    const res = await actualizaEstadoInvestigador(idInvestigador, 3);
    res ?
        Swal.fire('Información', res.message, 'success')
        :
        Swal.fire('Error', 'Ocurrió un error al actualizar el estado del investigador', 'error')
});

btnDenegar.addEventListener('click', async e => {
    e.preventDefault();
    const res = await actualizaEstadoInvestigador(idInvestigador, 4);
    res ?
        Swal.fire('Información', res.message, 'success')
        :
        Swal.fire('Error', 'Ocurrió un error al actualizar el estado del investigador', 'error')
});
