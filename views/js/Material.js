const materialData = {};
let materialsArray = [];

$(function () {
    $("#material_name_error_message").hide();
    $("#material_cantidad_error_message").hide();

    var error_name = false;
    var error_cantidad = false;

    $("#material-name").on("keyup", function () {
        check_name();
    });
    $("#material-cantidad").on("keyup", function () {
        check_cantidad();
    });


    function check_name() {
        var name = $("#material-name").val().trim();

        if (name.length < 1) {
            $("#material_name_error_message").html("Favor de ingresar el nombre del material")
            $("#material_name_error_message").show();
            $("#material-name").css("border", "2px solid #F90A0A");
            error_name = true;
        } else {
            $("#material_name_error_message").hide();
            $("#material-name").css("border", "2px solid #34f458", "margin-bottom", "0px");
            error_name = false;

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

        if (error_name === false && error_cantidad === false) {

            $("#material_error_messageCotizacion").hide();

            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');


            // Crear una copia superficial del objeto materialData
            const newMaterial = { ...materialData };

            // Establecer los valores del nuevo material
            newMaterial.idProducto = '';
            newMaterial.idStatus = '1';
            newMaterial.Fecha_creacion = formattedDate;
            newMaterial.Nombre = $('#material-name').val();
            newMaterial.Cantidad = $('#material-cantidad').val();

            // Almacena el nuevo objeto en el array
            materialsArray.push(newMaterial);

            // Puedes imprimir el array en la consola para verificar
            console.log(materialsArray);

            // Llama a la función para actualizar la lista de materiales
            updateMaterialsList();

            $('#addmaterial').modal('hide');//cierra modal
            // Obtener los elementos de entrada de archivo
            const nameMate = document.getElementById('material-name');
            const cantidadMate = document.getElementById('material-cantidad');

            //vacia los input 
            nameMate.value = '';
            cantidadMate.value = '';
            $("#material_name_error_message").hide();
            $("#material_cantidad_error_message").hide();
            return false;

        } else {
            $("#category_error_message").html("Por favor llene correctamente todos los campos")
            $("#category_error_message").show();
            return false;
        }

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
    }


})

export { materialsArray };