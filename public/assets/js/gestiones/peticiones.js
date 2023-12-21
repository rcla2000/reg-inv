const peticion = async (ruta, metodo = 'GET', token = null, cuerpo = null) => {
    try {
        const request = metodo === 'GET' ? await fetch(ruta) : await fetch(ruta, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            method: metodo,
            body: JSON.stringify(cuerpo)
        });
    
        const json = await request.json();
        return {
            status: request.status,
            json: json
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Ha ocurrido un error inesperado', 'error');
    }
}