
function previewImage() {
    $('#preview-img-Uploadlist').hide();
    $('#img-Uploadlist').show();
    $("#photolist_error_message").hide();
    $("#Uploadlist").css("border", "1px solid #dee2e6");

    if (typeof (FileReader) != "undefined") {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview-img-Uploadlist').show();
            $('#preview-img-Uploadlist').attr('src', e.target.result);
            $('#img-Uploadlist').hide();
        }

        reader.readAsDataURL($("#Uploadlist")[0].files[0]);
    } else {
        alert("Este navegador no soporta FileReader.");
    }
}

function validateField(fieldId, pattern, errorId, errorMessage) {
    var fieldValue = $(fieldId).val().trim();

    if (fieldValue.length < 1) {
        $(errorId).html(errorMessage);
        $(errorId).show();
        $(fieldId).css("border", "1px solid #ff0000");
        return false;
    } else if (!pattern.test(fieldValue)) {
        $(errorId).html("El campo contiene caracteres inválidos");
        $(errorId).show();
        $(fieldId).css("border", "1px solid #ff0000");
        return false;
    } else {
        $(errorId).hide();
        $(fieldId).css("border", "1px solid #34f458");
        return true;
    }
}

function validateForm() {
    var isValid = true;

    // Validar imagen
    isValid = validateField("#Uploadlist", /^.+$/, "#photolist_error_message", "Por favor, selecciona una imagen") && isValid;

    // Validar nombre
    isValid = validateField("#category-list", /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/, "#list_name_error_message", "Favor de ingresar un nombre") && isValid;

    // Validar descripción
    isValid = validateField("#list-desc", /^.+$/, "#list_description_error_message", "Favor de ingresar una descripción") && isValid;

    // Validar modalidad
    isValid = validateField("#modo", /^.+$/, "#list_Modalidad_error_message", "Por favor, selecciona una modalidad") && isValid;

    return isValid;
}

function clearForm() {
    // Limpiar los campos del formulario
    $("#add-list-form")[0].reset();
    // Ocultar mensajes de error y restablecer estilos de borde
    $("span.text-danger").hide();
    $("input, textarea, select").css("border", "1px solid #dee2e6");

    // Limpiar la vista previa de la imagen
    $('#preview-img-Uploadlist').attr('src', '');
    $('#img-Uploadlist').show();
    $('#preview-img-Uploadlist').hide();
}

$(function () {
    $("#Uploadlist").on("change", function () {
        previewImage();
    });

    $("input, textarea, select").on("input", function () {
        var fieldId = "#" + $(this).attr("id");
        var pattern, errorMessage, errorId;

        switch ($(this).attr("id")) {
            case "category-list":
                pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
                errorMessage = "Favor de ingresar un nombre";
                errorId = "#list_name_error_message";
                break;

            case "list-desc":
                pattern = /^.+$/;
                errorMessage = "Favor de ingresar una descripción";
                errorId = "#list_description_error_message";
                break;

            case "modo":
                pattern = /^.+$/;
                errorMessage = "Por favor, selecciona una modalidad";
                errorId = "#list_Modalidad_error_message";
                break;

            default:
                pattern = /^.+$/;
                errorMessage = "";
                errorId = "";
        }

        validateField(fieldId, pattern, errorId, errorMessage);
    });

    $("#add-list-form").submit(function (e) {
        // Evitar el envío del formulario
        e.preventDefault();

        // Validar el formulario
        if (validateForm()) {
            // Crear un nuevo objeto FormData
            var formData = new FormData();

            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

            // Obtener los valores de los campos
            var imageFile = $("#Uploadlist")[0].files[0];
            var name = $("#category-list").val();
            var description = $("#list-desc").val();
            var mode = $("#modo").val();
            var idUserSesion = $("#idUserSesion").val();

            // Agregar valores al objeto FormData
            formData.append("idStatus", 1);
            formData.append("idUsuarioCreador", idUserSesion);
            formData.append("Imagen", imageFile);
            formData.append("Nombre", name);
            formData.append("Descripción", description);
            formData.append("Modo", mode);
            formData.append('Fecha_creacion', formattedDate);


            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/Lista/Alta_Lista.php", true);
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
                            title: ' La Lista se ha creado con éxito',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#F47B8F'
                        }).then((willDelete) => {
                            if (willDelete) {
                                // Limpiar el formulario después de dar de alta
                                clearForm();
                                $('#altaLista').modal('hide');//cierra modal
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


    $("#altaLista").on("hidden.bs.modal", function () {
        clearForm();
    });

}); 