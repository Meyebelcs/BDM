var accion;

function restarCantidad(idCarrito) {
    accion="resta";

    updateCarritoInfo(idCarrito);
    
}

function sumarCantidad(idCarrito) {
    accion="suma";

    updateCarritoInfo(idCarrito);
    
}

function updateCarritoInfo(idCarrito){

    const formData = new FormData();
    formData.append('accion', accion);
    formData.append('idCarrito', idCarrito);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/Carrito/UpdateCarrito.php", true);
    xhr.onreadystatechange = function () {
        try {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let res = JSON.parse(xhr.response);
                if (res.success !== true) {
                    Swal.fire({
                        title: 'Error',
                        text: res.msg, // El mensaje de error que obtiene del servidor
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    });
                    return;
                }

                // Éxito...
                Swal.fire({
                    title: res.msg,
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F47B8F'
                }).then((willDelete) => {
                    if (willDelete) {
                        location.reload();

                    } else {
                        alert("error");
                    }
                });

                console.log(res.msg);
            }
        } catch (error) {
            // Imprimir error del servidor
            console.error(xhr.response);
        }
    };

    // Enviar formData
    xhr.send(formData);
    return false;
};
