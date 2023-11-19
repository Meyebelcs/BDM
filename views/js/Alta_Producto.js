
$(document).ready(function () {

    //---------switch----------------
    $('.productosCotizacion').hide();
    $('.productosStock').show();

    $('#switchInput').change(function () {
        if ($(this).is(':checked')) {
            $('#switchText').text('Crear Cotización');
            $('.productosStock').hide();
            $('.productosCotizacion').show();
        } else {
            $('#switchText').text('Añadir Productos');
            $('.productosCotizacion').hide();
            $('.productosStock').show();
        }
    });
    //---------------select categorias-----------------
    $("#select-categories").select2({
        placeholder: "Selecciona categorías", //placeholder
        tags: true,
        tokenSeparators: ['/', ',', ';', " "]
    });
    $("#select-categoriesCotizacion").select2({
        placeholder: "Selecciona categorías", //placeholder
        tags: true,
        tokenSeparators: ['/', ',', ';', " "]
    });

    // Esconder todos los mensajes de error de stock y cotizacion
    $("#name_error_message, #description_error_message, #categories_error_message, #price_error_message, #inventario_error_message, #img_error_message").hide();
    $("#name_error_messageCotizacion, #description_error_messageCotizacion, #categories_error_messageCotizacion, #img_error_messageCotizacion, #material_error_messageCotizacion").hide();

    // Variables de error
    var error_name = false;
    var error_desc = false;
    var error_category = false;
    var error_price = false;
    var error_inventario = false;
    var error_img = false;
    var error_material = false;

    // Asociar funciones de validación a eventos
    $("#name").on("keyup", check_name);
    $("#desc").on("keyup", check_desc);
    $("#price").on("keyup", check_price);
    $("#inventario").on("keyup", check_inventario);
    $("#select-categories").on("change", check_category);
    $("#Upload").on("change", check_img);

    $("#nameCotizacion").on("keyup", check_nameCotizacion);
    $("#descCotizacion").on("keyup", check_descCotizacion);
    $("#select-categoriesCotizacion").on("change", check_categoryCotizacion);
    $("#UploadCotizacion").on("change", check_imgCotizacion);
    $("#material_error_messageCotizacion").on("change", check_materialCotizacion);

    // Funciones de validación
    function showError(element, message) {
        element.html(message).show();
    }

    function hideError(element) {
        element.hide();
    }

    function validateField(value, errorElement, errorMessage, successElement) {
        if (value.length < 1) {
            showError(errorElement, errorMessage);
            successElement.css("border", "2px solid #F90A0A");
            return true;
        } else {
            hideError(errorElement);
            successElement.css("border", "2px solid #34f458").css("margin-bottom", "0px");
            return false;
        }
    }

    function validateNumericField(value, errorElement, errorMessage, successElement) {
        var pattern = /^\d+$/;
        var numericValue = parseInt(value, 10);

        if (value.length < 1 || !pattern.test(value) || numericValue <= 0) {
            showError(errorElement, errorMessage);
            successElement.css("border", "2px solid #F90A0A");
            return true;
        } else {
            hideError(errorElement);
            successElement.css("border", "2px solid #34f458").css("margin-bottom", "0px");
            return false;
        }
    }

    // Funciones de validación STOCK

    function check_name() {
        error_name = validateField($("#name").val().trim(), $("#name_error_message"), "Favor de ingresar un nombre al curso", $("#name"));
    }

    function check_desc() {
        error_desc = validateField($("#desc").val().trim(), $("#description_error_message"), "Favor de ingresar una descripción al curso", $("#desc"));
    }

    function check_price() {
        error_price = validateField($("#price").val().trim(), $("#price_error_message"), "Favor de ingresar un costo al curso", $("#price"));
    }

    function check_inventario() {
        error_inventario = validateNumericField($("#inventario").val().trim(), $("#inventario_error_message"), "Favor de ingresar un inventario", $("#inventario"));
    }

    function check_category() {
        var categories = $("#select-categories").val();
        if (categories == null) {
            $("#categories_error_message").html("Favor de seleccionar al menos una categoría")
            $("#categories_error_message").show();
            $("#select-categories").css("border", "2px solid #F90A0A");
            error_category = true;
        } else {
            $("#categories_error_message").hide();
            $("#select-categories").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_img() {
        var img = $("#Upload").val().trim();
        if (img.length < 1) {
            $("#photo_error_message").html("Favor de seleccionar una fotografía")
            $("#photo_error_message").show();
            $("#Upload").css("border", "2px solid #F90A0A");
            error_img = true;
        } else {
            $("#photo_error_message").hide();
            $("#Upload").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    // Funciones de validación cotizacion

    function check_nameCotizacion() {
        error_name = validateField($("#nameCotizacion").val().trim(), $("#name_error_messageCotizacion"), "Favor de ingresar un nombre a la cotización", $("#nameCotizacion"));
    }

    function check_descCotizacion() {
        error_desc = validateField($("#descCotizacion").val().trim(), $("#description_error_messageCotizacion"), "Favor de ingresar una descripción a la cotización", $("#descCotizacion"));
    }

    function check_categoryCotizacion() {
        var categories = $("#select-categoriesCotizacion").val();
        if (categories == null) {
            $("#categories_error_messageCotizacion").html("Favor de seleccionar al menos una categoría")
            $("#categories_error_messageCotizacion").show();
            $("#select-categoriesCotizacion").css("border", "2px solid #F90A0A");
            error_category = true;
        } else {
            $("#categories_error_messageCotizacion").hide();
            $("#select-categoriesCotizacion").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_imgCotizacion() {
        var img = $("#UploadCotizacion").val().trim();
        if (img.length < 1) {
            $("#photo_error_messageCotizacion").html("Favor de seleccionar una fotografía")
            $("#photo_error_messageCotizacion").show();
            $("#UploadCotizacion").css("border", "2px solid #F90A0A");
            error_img = true;
        } else {
            $("#photo_error_messageCotizacion").hide();
            $("#UploadCotizacion").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }


    function check_materialCotizacion() {
        const levels = $(".levels .accordion-item");

        if (levels.length === 0) {
            $("#material_error_messageCotizacion").html("Debe ingresar materiales a la cotización");
            $("#material_error_messageCotizacion").show();
            error_material = true;
        } else {
            $("#material_error_messageCotizacion").hide();
            error_material = false;
        }
    }
    /* ==================== agregar Producto================ */

    $("#create-Product").on('submit', function () {

        event.preventDefault();


        check_name();
        check_desc();
        check_price();
        check_inventario();
        check_category();
        check_img();

        if (error_name === false && error_desc === false && error_category === false && error_inventario === false && error_price === false && error_img === false) {

            var formData = new FormData();

            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

            //obtengo el valor de los campos
            nombre = $('#name').val();
            descripcion = $('#desc').val();
            costo = $('#price').val();
            inventario = $('#inventario').val();
            tipo = 'Stock';
            fechaActualizacion = fechaPublicacion = formattedDate;
            idStatus = '1';
            idUsuarioCreador = idAdminAutorizacion = $('#idUser').val();

            formData.append('Nombre', nombre);
            formData.append('Descripción', descripcion);
            formData.append('Precio', costo);
            formData.append('Inventario', inventario);
            formData.append('Fecha_actualizacion', fechaActualizacion);
            formData.append('Fecha_publicación', fechaPublicacion);
            formData.append('idStatus', idStatus);
            formData.append('idAdminAutorización', idAdminAutorizacion);
            formData.append('idUsuarioCreador', idUsuarioCreador);
            formData.append('Tipo', tipo);

            // Itera sobre el array de imágenes y agrégales al FormData
            for (var i = 0; i < imagenesStock.length; i++) {
                formData.append("imagenesStock[]", imagenesStock[i]);
            }


            // Itera sobre el array de categoria y agrégales al FormData
            var selectElement = document.getElementById("select-categories");
            var selectedOptions = [];

            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].selected) {
                    selectedOptions.push(selectElement.options[i].id);
                }
            }

            selectedOptions.forEach(function (option) {
                formData.append('categorias[]', option);
            });

            console.log("Imágenes antes de enviar la solicitud:", imagenesStock);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/Producto/Alta_Producto.php", true);
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
                            title:' El Producto se ha creado con éxito',
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

            // Enviar FormData en lugar de JSON
            xhr.send(formData);

            return false;
        } else {
            $("#modal_error_message").html("Por favor llene correctamente todos los campos")
            $("#modal_error_message").show();
            return false;
        }

    })

    //===============COTIZACIONES======================
    $("#formCotizacion").on('submit', function () {

        event.preventDefault();


        check_nameCotizacion();
        check_descCotizacion();
        check_categoryCotizacion();
        check_imgCotizacion();
        check_materialCotizacion();

        if (error_name === false && error_desc === false && error_category === false && error_img === false && error_material === false) {

           
            var formDataCotizacion = new FormData();

            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');


            //obtengo el valor de los campos
            nombre = $('#nameCotizacion').val();
            descripcion = $('#descCotizacion').val();
            tipo = 'Cotizacion';
            fechaActualizacion = fechaPublicacion = formattedDate;
            idStatus = '2';
            idUsuarioCreador = idAdminAutorizacion = $('#idUser').val();

            formDataCotizacion.append('Nombre', nombre);
            formDataCotizacion.append('Descripción', descripcion);
            formDataCotizacion.append('Precio', ' ');
            formDataCotizacion.append('Inventario', ' ');
            formDataCotizacion.append('Fecha_actualizacion', fechaActualizacion);
            formDataCotizacion.append('Fecha_publicación', fechaPublicacion);
            formDataCotizacion.append('idStatus', idStatus);
            formDataCotizacion.append('idAdminAutorización', idAdminAutorizacion);
            formDataCotizacion.append('idUsuarioCreador', idUsuarioCreador);
            formDataCotizacion.append('Tipo', tipo);

            // Itera sobre el array de imágenes y agrégales al FormData
            for (var i = 0; i < imagenesCotizacion.length; i++) {
                formDataCotizacion.append("imagenesCotizacion[]", imagenesCotizacion[i]);
            }

            // Itera sobre el array de categoria y agrégales al FormData
            var selectElement = document.getElementById("select-categoriesCotizacion");
            var selectedOptions = [];

            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].selected) {
                    selectedOptions.push(selectElement.options[i].id);
                }
            }

            selectedOptions.forEach(function (option) {
                formDataCotizacion.append('categorias[]', option);
            });

            console.log("Imágenes antes de enviar la solicitud:", imagenesCotizacion);


            const xhr = new XMLHttpRequest();

            xhr.open("POST", "../controllers/Producto/Alta_Cotizacion.php", true);
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
                            title: res.msg + ' La Cotización se ha creado con éxito',
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
        } else {
            $("#modal_error_message").html("Por favor llene correctamente todos los campos")
            $("#modal_error_message").show();
            return false;
        }
    })

    var imagenesStock = []; // Declarar un array global para almacenar las imágenes

    $("#Upload").on("change", function () {
        var container = $("#image-previews-container");
    
        $("#photo_error_message").hide();
        $("#Upload").css("border", "1px solid #dee2e6");
    
        if (typeof FileReader !== "undefined") {
            var files = $(this)[0].files;
    
            for (var i = 0; i < files.length; i++) {
                var objectURL = URL.createObjectURL(files[i]);
    
                // Validar el tamaño de la imagen
                if (validateImageSize(files[i])) {
                    container.append('<img src="' + objectURL + '" class="preview-img" alt="">');
    
                    // Agrega cada imagen al array global
                    imagenesStock.push(files[i]);
                } else {
                    // Manejar el error de tamaño de la imagen
                    Swal.fire({
                        title: 'Error',
                        text:"Error: La imagen '" + files[i].name + "' supera el tamaño permitido.",
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    });
                }
            }
    
            // Imprimir el contenido de imagenesStock en la consola de manera entendible
            console.log("Imágenes antes de enviar la solicitud:");
            console.log(JSON.stringify(imagenesStock, null, 2));
        } else {
            alert("Este navegador no admite FileReader.");
        }
    });

    // ----- muestra la imagen seleccionada ----
    var imagenesCotizacion = []; // Declarar un array global para almacenar las imágenes

    $("#UploadCotizacion").on("change", function () {
        var container = $("#image-previews-container-Cotizacion");

        $("#img_error_messageCotizacion").hide();
        $("#UploadCotizacion").css("border", "1px solid #dee2e6");

        if (typeof FileReader !== "undefined") {
            var files = $(this)[0].files;
    
            for (var i = 0; i < files.length; i++) {
                var objectURL = URL.createObjectURL(files[i]);
    
                // Validar el tamaño de la imagen
                if (validateImageSize(files[i])) {
                    container.append('<img src="' + objectURL + '" class="preview-img" alt="">');
    
                    // Agrega cada imagen al array global
                    imagenesCotizacion.push(files[i]);
                } else {
                    // Manejar el error de tamaño de la imagen
                    Swal.fire({
                        title: 'Error',
                        text:"Error: La imagen '" + files[i].name + "' supera el tamaño permitido.",
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    });
                }
            }
    
            // Imprimir el contenido de imagenesStock en la consola de manera entendible
            console.log("Imágenes antes de enviar la solicitud:");
            console.log(JSON.stringify(imagenesCotizacion, null, 2));
        } else {
            alert("Este navegador no admite FileReader.");
        }

    });

        
    function validateImageSize(file) {
        // Define el tamaño máximo permitido para LONGBLOB (en bytes)
        var maxSizeAllowed = 4294967295;  // 4 GB
    
        // Verifica si el tamaño del archivo excede el límite
        return file.size <= maxSizeAllowed;
    }
    
})