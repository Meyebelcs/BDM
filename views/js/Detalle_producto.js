$("#review").on('keyup', function () {
    var review = $("#review").val().trim();

    if (review.length < 1) {
        $("#error_message").html("Ingrese un comentario");
        $("#error_message").show();
    } else {
        $("#error_message").hide();
    }
});

var idProducto = document.querySelector('input[name="ReviewidProduct"]').value;
var idUsuario = document.querySelector('input[name="ReviewidUsuario"]').value;

$("#makeReview").on('submit', function (event) {
    event.preventDefault(); // Evita el comportamiento predeterminado de recarga de la página

    var review = $("#review").val().trim();

    if (review.length < 1) {
        $("#error_message").html("Ingrese un comentario");
        $("#error_message").show();
        return false;
    } else {

        var comentario = $("#review").val();

        const now = new Date();
        
        const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

        var formData = new FormData();
        formData.append('Comentario', comentario);
        formData.append('Calificacion', selectedStars);
        formData.append('idProducto', idProducto);
        formData.append('idUsuarioCreador', idUsuario);
        formData.append('idStatus', 1);
        formData.append('Fecha_publicacion', formattedDate);

        

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/Comentario/Alta_Comentario.php", true);
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
                    Swal.fire({
                        title: 'El comentario se publicó con éxito',
                        html: '<div>¡Gracias por tu contribución!</div>',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    }).then((willDelete) => {
                        if (willDelete) {
                            location.reload();
                           /*  //location.reload();  

                            //ACTUALIZAR LOS COMENTARIOS
                            // Parsea el JSON de la respuesta
                            const response = JSON.parse(xhr.responseText);
                            // Accede a la lista de categorías
                            const comentarios = response.comentarios;

                            // Construye las opciones con toda la información
                            const optionsHTML = comentarios.map(comentario => {
                                return `<br>
                                <img src="../Files/${comentario.imagenUsuario}" alt="Imagen de usuario" style="width: 35px; height: 35px; border-radius: 50%;">
                                <br>
                                <strong>${comentario.username}</strong><br>
                                <div class="calificacion pb-2">
                                Calificación: 
                                ${'<i class="bi bi-star-fill"></i>'.repeat(Math.floor(comentario.calificacion))}
                                ${'<i class="bi bi-star"></i>'.repeat(5 - Math.floor(comentario.calificacion))}
                                </div>
                                <br>
                                ${comentario.Fecha_publicacion}
                                <br>
                                ${comentario.comentario}
                                <br>
                                `;
                            }).join('');

                            // Actualiza el contenido del contenedor 
                            document.getElementById('comentarioslist').innerHTML = optionsHTML; */


                        } else {
                            alert("error");
                        }
                    });
                    document.getElementById('review').value = "";
                    console.log(res.msg);
                }
            } catch (error) {
                // Imprimir error del servidor
                console.error(xhr.response);
            }
        };

        // Enviar FormData en lugar de JSON
        xhr.send(formData);



        return false;
    }
});

// Declarar la variable selectedStars en el ámbito global
let selectedStars = 0;

document.addEventListener('DOMContentLoaded', function () {
    const ratings = document.getElementsByClassName('rating');
    Array.from(ratings).forEach(rating => {
        const rateStars = rating.getElementsByClassName('bi-star');
        const arrayRateStars = Array.from(rateStars);

        arrayRateStars.forEach(rateStar => {
            rateStar.addEventListener('click', (event) => {
                const starNumber = event.target.getAttribute('star');
                arrayRateStars.forEach(rateStar => {
                    const starValue = rateStar.getAttribute('star');
                    if (starValue <= starNumber) {
                        rateStar.classList.remove('bi-star');
                        rateStar.classList.add('bi-star-fill');
                    } else {
                        rateStar.classList.add('bi-star');
                        rateStar.classList.remove('bi-star-fill');
                    }
                });
                selectedStars = parseInt(starNumber); // Actualizar la cantidad de estrellas seleccionadas
                const ratingId = rating.getAttribute('data-rating-id');
                console.log('Estrellas seleccionadas:', selectedStars);
                console.log('ID único del conjunto:', ratingId);
            });
        });
    });
});