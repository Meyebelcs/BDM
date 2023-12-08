const materialData = {};
let materialsArray = [];
var selectedidMaterialCb = 0;


$(function () {

    //--------botones de carrito y cotizacion--------------
    var btnAgregarCarrito = document.getElementById('btnAgregarCarritoBoton');
    var btnCrearCotizacion = document.getElementById('btnCrearCotizacion');


    // Agrega un evento al botón para capturar el clic
    btnAgregarCarrito.addEventListener('click', function () {
        alert('clic btnAgregarCarrito' );
        updatecotizacion();
    });

    // Agrega un evento al botón para capturar el clic
    btnCrearCotizacion.addEventListener('click', function () {
        alert('clic btnCrearCotizacion');
        crearcotizacion();
        mostrarBoton();
    });

    //---------------------------------------------------


    $("#material_name_error_message").hide();
    $("#material_cantidad_error_message").hide();

    var error_name = false;
    var error_cantidad = false;

    $("#MaterialList").on("keyup", function () {
        check_name();
    });
    $("#material-cantidad").on("keyup", function () {
        check_cantidad();
    });


    function check_name() {
        var selectedMaterial = $("#MaterialList").val();

        if (selectedMaterial) {
            $("#material_name_error_message").hide();
            $("#MaterialList").css("border", "2px solid #34f458");
            error_name = false;
        } else {
            $("#material_name_error_message").html("Favor de ingresar el nombre del material");
            $("#material_name_error_message").show();
            $("#MaterialList").css("border", "2px solid #F90A0A");
            error_name = true;
        }


    }
    function check_cantidad() {
        var cantidad = $("#material-cantidad").val().trim();
        var pattern = /^\d+$/;
        var numericValue = parseInt(cantidad, 10);

        if (cantidad.length < 1) {
            $("#material_cantidad_error_message").html("Favor de ingresar una cantidad")
            $("#material_cantidad_error_message").show();
            $("#material-cantidad").css("border", "2px solid #F90A0A");
            error_cantidad = true;
        } else if (!pattern.test(cantidad) || numericValue <= 0) {
            $("#material_cantidad_error_message").html("Favor de ingresar una cantidad valida")
            $("#material_cantidad_error_message").show();
            $("#material-cantidad").css("border", "2px solid #F90A0A");
            error_cantidad = true;
        }
        else {
            $("#material_cantidad_error_message").hide();
            $("#material-cantidad").css("border", "2px solid #34f458", "margin-bottom", "0px");
            error_cantidad = false;

        }
    }


    const submitBtn = document.querySelector('#add-material-btn');
    submitBtn.addEventListener('click', function () {
        error_name = false;
        error_cantidad = false;

        check_name();
        check_cantidad();

        const selectedMaterial = $('#MaterialList').val();

        // Verificar si el material ya ha sido seleccionado
        const isMaterialSelected = materialsArray.some(material => material.Nombre === selectedMaterial);

        if (error_name === false && error_cantidad === false) {
            if (!isMaterialSelected) {
                // Resto del código para agregar el material
                const now = new Date();
                const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

                // Crear una copia superficial del objeto materialData
                const newMaterial = { ...materialData };

                // Establecer los valores del nuevo material
                newMaterial.Nombre = $('#MaterialList').val();
                newMaterial.Cantidad = $('#material-cantidad').val();
                newMaterial.idMaterial = selectedidMaterialCb;

                // Almacena el nuevo objeto en el array
                materialsArray.push(newMaterial);

                // Puedes imprimir el array en la consola para verificar
                console.log(materialsArray);

                // Llama a la función para actualizar la lista de materiales
                updateMaterialsList();

                $('#addmaterial').modal('hide'); // cierra modal

                // Obtener los elementos de entrada de archivo
                const nameMate = document.getElementById('MaterialList');
                const cantidadMate = document.getElementById('material-cantidad');

                // vacía los input
                nameMate.value = '';
                cantidadMate.value = '';
                $("#material_name_error_message").hide();
                $("#material_cantidad_error_message").hide();
                return false;
            } else {
                Swal.fire({
                    title: 'Error',
                    text: "Este material ya ha sido seleccionado.",
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F47B8F'
                });
                return false;
            }
        } else {
            $("#category_error_message").html("Por favor llene correctamente todos los campos")
            $("#category_error_message").show();
            return false;
        }
    });

    $("#MaterialList").change(function () {

        // Obtener el ID del material seleccionado
        selectedidMaterialCb = $(this).find(':selected').attr('id');

        // Hacer algo con el ID del material seleccionado
        console.log("ID del material seleccionado: " + selectedidMaterialCb);
    });

    //--------------------------------editar material----------------
    let materialIndex;
    // Evento al hacer clic en el botón de editar
    $(document).on("click", ".edit-material-btn", function () {
        // Obtiene el índice del material que se va a editar
        materialIndex = '';
        materialIndex = $(this).data('material-index');

        // Verifica si el índice es válido
        console.log('Material Index:', materialIndex);

        // Utiliza el índice para obtener el material correspondiente del array
        const materialToEdit = materialsArray[materialIndex];

        // Verifica si el material a editar está definido
        console.log('Material to Edit:', materialToEdit);

        // Llena los campos del formulario de edición con la información del material
        $('#material-edit-name').val(materialToEdit.Nombre);
        $('#material-edit-price').val(materialToEdit.Cantidad);

        // Muestra el modal de edición
        $('#editmaterial').modal('show');
    });
    // Evento al hacer clic en el botón "Guardar cambios"
    $('#edit-material-btn').on('click', function () {

        // Obtiene los valores editados del formulario
        const editedName = $('#material-edit-name').val();
        const editedCantidad = $('#material-edit-price').val();

        const materialToEdit = materialsArray[materialIndex];
        if (materialToEdit !== undefined) {


            // Utiliza el índice para actualizar la información del material en el array
            materialToEdit.Nombre = editedName;
            materialToEdit.Cantidad = editedCantidad;

            // Cierra el modal de edición
            $('#editmaterial').modal('hide');

            // Llama a la función para actualizar la lista de materiales
            updateMaterialsList();

        } else {
            console.error('Material to Edit is undefined.');
        }

    });


    //--------------------------------eliminar material----------------

    // Evento al hacer clic en el botón de eliminar
    $(document).on("click", ".delete-material-btn", function () {
        // Obtiene el índice del material que se va a editar
        materialIndex = '';
        materialIndex = $(this).data('material-index');

        // Verifica si el índice es válido
        console.log('Material Index:', materialIndex);

        // Muestra el modal de edición
        $('#deletematerial').modal('show');
    });

    // Evento al hacer clic en el botón "eliminar"
    $('#delete-material-btn').on('click', function () {

        const materialToDelete = materialsArray[materialIndex];
        if (materialToDelete !== undefined) {


            // Elimina el material del array en el índice especificado
            materialsArray.splice(materialIndex, 1);

            // Cierra el modal de edición
            $('#deletematerial').modal('hide');

            // Llama a la función para actualizar la lista de materiales
            updateMaterialsList();

        } else {
            console.error('Material to delete is undefined.');
        }

    });

    // Función para actualizar la lista de materiales en el HTML
    function updateMaterialsList() {
        // Obtiene el contenedor donde se agregarán los elementos de la lista de materiales
        const materialesContainer = document.getElementById('levels');

        // Limpia el contenido existente en el contenedor
        materialesContainer.innerHTML = '';

        // Itera sobre el array de materiales y crea dinámicamente los elementos HTML
        materialsArray.forEach((material, index) => {
            // Crea el elemento div para el material
            const materialDiv = document.createElement('div');
            materialDiv.className = 'accordion-item';

            // Construye el contenido del material
            const materialContent = `
            <h2 class="accordion-header bg-light">
                <div class="d-flex justify-content-between p-2">
                    <p class="btn border-0 m-0">${material.Nombre}</p>
                    <p class="btn border-0 m-0">Cantidad: ${material.Cantidad}</p>
                    <p class="btn border-0 m-0">idMaterial: ${material.idMaterial}</p>
                    <div class="d-flex justify-content-center">
                        <button class="btn collapsed border-0 edit-material-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#editmaterial" data-material-index="${index}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button class="btn collapsed border-0 text-danger delete-material-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#deletematerial" data-material-index="${index}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </div>
            </h2>
        `;

            // Asigna el contenido al div del material
            materialDiv.innerHTML = materialContent;

            // Agrega el div del material al contenedor
            materialesContainer.appendChild(materialDiv);
        });
    };

    // Función para hacer visible el botón
    function mostrarBoton() {

        //update al boton y ponerle status espera

        var formData = new FormData();
        formData.append('idProducto', $('#idProductoHidden').val());
        formData.append('idChat', $('#idChatHidden').val());


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/CotizacionTemporal/Update_CotizacionTemporal.php", true);
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
                    location.reload();
                }
            } catch (error) {
                // Imprimir error del servidor
                console.error(xhr.response);
            }
        };

        xhr.send(formData);

    };

    function updatecotizacion() {

        const now = new Date();
        var formData = new FormData();
        formData.append('idCarrito', $('#idCarritoHidden').val());
        formData.append('idProducto', $('#idProductoHidden').val());
        formData.append('idChat', $('#idChatHidden').val());


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/Carrito/Update_Cotizacion_Carrito.php", true);
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
                        title: 'Se agregó a carrito',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = `./Carrito.php`;

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
    };

    function crearcotizacion() {

        const now = new Date();

        const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

        var formData = new FormData();
        formData.append('Descripcion', $('#miTextarea').val());
        formData.append('idProducto', $('#idProductoHidden').val());
        formData.append('Cantidad', $('#cantidadCoti').val());
        formData.append('idChat', $('#idChatHidden').val());
        formData.append('fECHA', formattedDate);

        //materiales
        for (var i = 0; i < materialsArray.length; i++) {
            const material = materialsArray[i];
            formData.append("materiales[" + i + "][Nombre]", material.Nombre);
            formData.append("materiales[" + i + "][Cantidad]", material.Cantidad);
            formData.append("materiales[" + i + "][idMaterial]", material.idMaterial);
            formData.append("materiales[" + i + "][Fecha_creacion]", material.Fecha_creacion);
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/Carrito/Alta_Carrito_Cotizacion.php", true);
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
                        title: 'Se creó la cotizacion',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.reload();

                        } else {
                            alert("error");
                        }
                    });
                    console.log(res.msg);
                }
            } catch (error) {
                console.error(xhr.response);
            }
        };

        xhr.send(formData);
    };

})

export { materialsArray };