document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencias a los botones por su ID
    var btnAceptar = document.getElementById("btnAceptar");
    var btnDeclinar = document.getElementById("btnDeclinar");


    
    btnAceptar.addEventListener("click", function (event) {
       
        alert("Clic en Aceptar");
        var idProducto = event.currentTarget.dataset.idproducto;

        var formDataCotizacion = new FormData();

        const now = new Date();

        //obtengo el valor de los campos
        formDataCotizacion.append('idStatus', '1');
        formDataCotizacion.append('idProducto', idProducto);


        const xhr = new XMLHttpRequest();

        xhr.open("POST", "../controllers/Producto/EditarStatus_Cotizacion.php", true);
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
                        title: ' La Cotización se ha activado con éxito',
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

        // Enviar formDataCotizacion en lugar de JSON
        xhr.send(formDataCotizacion);
        return false;
    });

    btnDeclinar.addEventListener("click", function (event) {
        // Lógica cuando se hace clic en Declinar
        var idProducto = event.currentTarget.dataset.idproducto;
        alert("Clic en Declinar");

        var formDataCotizacion = new FormData();

        const now = new Date();

        //obtengo el valor de los campos
        formDataCotizacion.append('idStatus', '3');
        formDataCotizacion.append('idProducto', idProducto);


        const xhr = new XMLHttpRequest();

        xhr.open("POST", "../controllers/Producto/EditarStatus_Cotizacion.php", true);
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
                        title: ' La Cotización se ha eliminado con éxito',
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

        // Enviar formDataCotizacion en lugar de JSON
        xhr.send(formDataCotizacion);
        return false;
    });
});