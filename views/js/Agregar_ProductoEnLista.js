
var selectedidlistaCb = 0;
var productId = 0;


$(function () {

    $("#lista_name_error_message").hide();

    var error_name = false;

    $("#nombreList").on("keyup", function () {
        check_name();
    });

    function check_name() {
        var selectedMaterial = $("#nombreList").val();

        if (selectedMaterial) {
            $("#lista_name_error_message").hide();
            $("#nombreList").css("border", "2px solid #34f458");
            error_name = false;
        } else {
            $("#lista_name_error_message").html("Favor de seleccionar una lista");
            $("#lista_name_error_message").show();
            $("#nombreList").css("border", "2px solid #F90A0A");
            error_name = true;
        }


    }

    $('#addList').on('hidden.bs.modal', function () {
        // Limpia la selección del elemento con id 'nombreList'
        $('#nombreList').prop('selectedIndex', 0);
        $("#lista_name_error_message").hide();
       

    });

    $("#nombreList").change(function () {

        // Obtener el ID del material seleccionado
        selectedidlistaCb = $(this).find(':selected').attr('id');

        // Hacer algo con el ID del material seleccionado
        console.log("ID del name seleccionado: " + selectedidlistaCb);
        check_name();
    });

    const submitBtn = document.querySelector('#add-lista-btn');
    submitBtn.addEventListener('click', function () {
        error_name = false;
        error_cantidad = false;

        check_name();

        const selectedMaterial = $('#nombreList').val();


        if (error_name === false) {

            // Crear un nuevo objeto FormData
            var formData = new FormData();

            // Agregar valores al objeto FormData
            formData.append("idProducto", productId);
            formData.append("idLista", selectedidlistaCb);


            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/ProductoEnLista/Alta_ProductoEnLista.php", true);
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
                            title: ' Se añadió a la lista con éxito',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#F47B8F'
                        }).then((willDelete) => {
                            if (willDelete) {
                                // Limpiar el formulario después de dar de alta
                                $('#addList').modal('hide');//cierra modal
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

            // Enviar FormData en lugar de JSON
            xhr.send(formData);

            return false;

        }
    });

    document.getElementById('addListPlus').addEventListener('click', function () {
        // Obtiene el valor del atributo data-producto-id
        productId = this.getAttribute('data-producto-id');

        // Realiza acciones con el ID del producto
        console.log('ID del producto:', productId);

    });



})