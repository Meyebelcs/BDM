$(function () {
    $("#name_error_message").hide();
    $("#description_error_message").hide();

    var error_name = false;
    var error_desc = false;

    $("#category-name").on("keyup", function () {
        check_name();
    });
    $("#category-desc").on("keyup", function () {
        check_desc();
    });


    function check_name() {
        var name = $("#category-name").val().trim();

        if (name.length < 1) {
            $("#category_name_error_message").html("Favor de ingresar el nombre de la categoría")
            $("#category_name_error_message").show();
            $("#category-name").css("border", "2px solid #F90A0A");
            error_name = true;
        } else {
            $("#category_name_error_message").hide();
            $("#category-name").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }
    function check_desc() {
        var desc = $("#category-desc").val().trim();

        if (desc.length < 1) {
            $("#category_description_error_message").html("Favor de ingresar una descripción a la categoría")
            $("#category_description_error_message").show();
            $("#category-desc").css("border", "2px solid #F90A0A");
            error_desc = true;
        } else {
            $("#category_description_error_message").hide();
            $("#category-desc").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }



    $(document).on('click', '.AddCategoryClic', function () {

        // Obtener los elementos de entrada de archivo
        /*         const nombrecategory = document.getElementById('category-name');
                const descripcioncategory = document.getElementById('category-desc');
        
                //vacia los input 
                nombrecategory.value = '';
                descripcioncategory.value = '';
                $("#name_error_message").hide();
                $("#description_error_message").hide(); */

    });


    const submitBtn = document.querySelector('#btn_savechangesCat');
    submitBtn.addEventListener('click', function () {

        error_name = false;
        error_desc = false;

        check_name();
        check_desc();

        if (error_name === false && error_desc === false) {

            const formData = new FormData(document.querySelector('#create-category'));


            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

            //obtengo el valor de los campos
            nombre = $('#category-name').val();
            descripcion = $('#category-desc').val();
            fechaCreacion = formattedDate;
            idStatus = '1';
            idUsuarioCreador = $('#idUser').val();

            formData.append('idUsuarioCreador', idUsuarioCreador);
            formData.append('idStatus', idStatus);
            formData.append('Nombre', nombre);
            formData.append('Descripcion', descripcion);
            formData.append('Fecha_creacion', fechaCreacion);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/Categoria/Alta_Categoria.php", true);
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
                                // location.reload();

                                // Parsea el JSON de la respuesta
                                const response = JSON.parse(xhr.responseText);
                                // Accede a la lista de categorías
                                const categorias = response.categorias;
                                // Construye las opciones con toda la información
                                const optionsHTML = categorias.map(categoria => {
                                    return `<option id="${categoria.idCategoria}" value="${categoria.Nombre}">${categoria.Nombre}</option>`;
                                }).join('');
                                // Actualiza el contenido del contenedor con las nuevas opciones
                                document.getElementById('select-categoriesCotizacion').innerHTML = optionsHTML;
                                document.getElementById('select-categories').innerHTML = optionsHTML;


                                // Construye las nuevas opciones del menú desplegable
                                const newOptionsHTML = categorias.map(categoria => {
                                    return `<li><a class="dropdown-item"
                                    href="Busqueda.php?idCategoria=${categoria.idCategoria}">
                                    ${categoria.Nombre}
                                </a></li>`;
                                }).join('');
                                // Actualiza el contenido del menú desplegable con las nuevas opciones
                                document.querySelector('.dropdown-menu').innerHTML = newOptionsHTML;

                                $('#addCategory').modal('hide');//cierra modal
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

        } else {
            $("#category_error_message").html("Por favor llene correctamente todos los campos")
            $("#category_error_message").show();
            return false;
        }

    })

})