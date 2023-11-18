
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
    /* ==================== agregar Curso================ */

    $("#create-course").on('submit', function () {

        event.preventDefault();


        check_name();
        check_desc();
        check_price();
        check_inventario();
        check_category();
        check_img();

        if (error_name === false && error_desc === false && error_category === false && error_inventario === false && error_price === false && error_img === false && error_lesson === false && error_level === false) {


            //obtengo el valor de los campos
            costo_curso = $('#price').val();
            inventario_curso = $('#inventario').val();
            imagen = $('#Upload')[0].files[0];
            titulo = $('#name').val();
            descripcion = $('#desc').val();

            var formData = new FormData();

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

            formData.append('action', 'add');
            formData.append('costo_curso', costo_curso);
            formData.append('inventario_curso', inventario_curso);
            formData.append('imagen', imagen);
            formData.append('titulo', titulo);
            formData.append('descripcion', descripcion);

            /*  //verificar en la bd
               $.ajax({
                   type: 'POST',
                   url: '..//..//API//api-Cursos.php',
                   data:formData,
                   dataType: "json",
                   processData: false,
                   contentType: false,
                   success: function(data){
   
                       console.log(data);
   
                       Swal.fire({
                           title: 'El curso se ha guardado con éxito',
                           icon: 'success',
                           confirmButtonText: 'Aceptar',
                           confirmButtonColor:'#F47B8F'
                       }).then((willDelete) => {
                           if (willDelete) {
                               location.reload();
                           } else {
                             alert("error");
                           }
                       });
   
                   },
                   error: function(xhr, status, error){
                       console.log('Error', xhr);
                   }
               }); */
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
            alert('alta cotizacion');
        }
    })

    // ----- muestra la imagen seleccionada ----
    $("#Upload").on("change", function () {
        var container = $("#image-previews-container");

        $("#photo_error_message").hide();
        $("#Upload").css("border", "1px solid #dee2e6");

        if (typeof FileReader !== "undefined") {
            var files = $(this)[0].files;

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    container.append('<img src="' + e.target.result + '" class="preview-img" alt="">');
                };

                reader.readAsDataURL(files[i]);
            }
        } else {
            alert("This browser does not support FileReader.");
        }
    });

     // ----- muestra la imagen seleccionada ----
     $("#UploadCotizacion").on("change", function () {
        var container = $("#image-previews-container-Cotizacion");

        $("#img_error_messageCotizacion").hide();
        $("#UploadCotizacion").css("border", "1px solid #dee2e6");

        if (typeof FileReader !== "undefined") {
            var files = $(this)[0].files;

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    container.append('<img src="' + e.target.result + '" class="preview-img" alt="">');
                };

                reader.readAsDataURL(files[i]);
            }
        } else {
            alert("This browser does not support FileReader.");
        }
    });


})