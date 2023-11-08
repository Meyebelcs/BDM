$(function () {
    $("#fname_error_message").hide();
    $("#sname_error_message").hide();
    $("#gender_error_message").hide();
    $("#birthday_error_message").hide();
    $("#email_error_message").hide();
    $("#user_error_message").hide();
    $("#password_error_message").hide();
    $("#confirm_password_error_message").hide();
    $("#fusername_error_message").hide();
    $("#mod_error_message").hide();



    var error_fname = false;
    var error_sname = false;
    var error_gender = false;
    var error_birthday = false;
    var error_email = false;
    var error_password = false;
    var error_confirm_password = false;
    var error_photo = false;
    var error_susername = false;
    var error_mod = false;


    $("#edit-name").on("keyup", function () {
        $("#modal_error_message").hide();
        check_fname();
    });
    $("#edit-last-name").on("keyup", function () {
        $("#modal_error_message").hide();
        check_sname();
    });
    $("#edit-gender").on("click", function () {
        $("#modal_error_message").hide();
        check_gender();
    });
    $("#edit-birthday").on("change", function () {
        $("#modal_error_message").hide();
        check_birthday();
    });
    $("#edit-email").on("keyup", function () {
        $("#modal_error_message").hide();
        check_email();
    });
    $("#edit-password").on("keyup", function () {
        $("#modal_error_message").hide();
        check_password();
        check_confirm_password();
    });
    $("#retype-password").on("keyup", function () {
        $("#modal_error_message").hide();
        check_confirm_password();
    });
    $("#edit-username").on("keyup", function () {
        $("#modal_error_message").hide();
        check_fusername();
    });
    $("#edit-mod").on("click", function () {
        $("#modal_error_message").hide();
        check_mod();
    });

    function check_fname() {
        var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
        var fname = $("#edit-name").val().trim();

        if (fname.length < 1) {
            $("#fname_error_message").html("Favor de ingresar un nombre")
            $("#fname_error_message").show();
            $("#edit-name").css("border", "2px solid #F90A0A");
            error_fname = true;
        } else if (!pattern.test(fname)) {
            $("#fname_error_message").html("El campo contiene caracteres invalidos")
            $("#fname_error_message").show();
            $("#edit-name").css("border", "2px solid #F90A0A");
            error_fname = true;
        } else {
            $("#fname_error_message").hide();
            $("#edit-name").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_fusername() {

        var fusername = $("#edit-username").val().trim();

        if (fusername.length < 1) {
            $("#fusername_error_message").html("Favor de ingresar un nombre de usuario")
            $("#fusername_error_message").show();
            $("#edit-username").css("border", "2px solid #F90A0A");
            error_fusername = true;
        } else if (fusername.length > 15) {
            $("#fusername_error_message").html("El nombre de usuario debe tener como máximo 15 caracteres");
            $("#fusername_error_message").show();
            $("#edit-username").css("border", "2px solid #F90A0A");
            error_fusername = true;
        } else {
            $("#fusername_error_message").hide();
            $("#edit-username").css("border", "2px solid #34f458", "margin-bottom", "0px");
            error_fusername = false;
        }
    }

    function check_mod() {
        var mod = $("#edit-mod").val().trim();

        if (mod === "") {
            $("#mod_error_message").html("Favor de seleccionar una modalidad")
            $("#mod_error_message").show();
            $("#edit-mod").css("border", "2px solid #F90A0A");
            error_mod = true;
        } else {
            $("#mod_error_message").hide();
            $("#edit-mod").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_gender() {
        var gender = $("#edit-gender").val().trim();

        if (gender === "") {
            $("#gender_error_message").html("Favor de seleccionar un género")
            $("#gender_error_message").show();
            $("#edit-gender").css("border", "2px solid #F90A0A");
            error_gender = true;
        } else {
            $("#gender_error_message").hide();
            $("#edit-gender").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_birthday() {
        var fecha = $("#edit-birthday").val();

        if (fecha.length < 1) { //Valida que no esté vacío
            $("#birthday_error_message").html("Favor de seleccionar una fecha")
            $("#birthday_error_message").show();
            $("#edit-birthday").css("border", "2px solid #F90A0A");
            error_birthday = true;
        } else if (validateDate(fecha)) {
            $("#birthday_error_message").html("La fecha no es válida")
            $("#birthday_error_message").show();
            $("#edit-birthday").css("border", "2px solid #F90A0A");
            error_birthday = true;
        } else {
            $("#birthday_error_message").hide();
            $("#edit-birthday").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_sname() {
        var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
        var sname = $("#edit-last-name").val().trim();

        if (sname.length < 1) {
            $("#sname_error_message").html("Favor de ingresar el apellido")
            $("#sname_error_message").show();
            $("#edit-last-name").css("border", "2px solid #F90A0A");
            error_sname = true;
        } else if (!pattern.test(sname)) {
            $("#sname_error_message").html("El campo contiene caracteres invalidos")
            $("#sname_error_message").show();
            $("#edit-last-name").css("border", "2px solid #F90A0A");
            error_sname = true;
        } else {
            $("#sname_error_message").hide();
            $("#edit-last-name").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_email() {
        var pattern = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        var email = $("#edit-email").val().trim();

        if (email.length < 1) {
            $("#email_error_message").html("Favor de ingresar un email")
            $("#email_error_message").show();
            $("#edit-email").css("border", "2px solid #F90A0A");
            error_email = true;
        } else if (!pattern.test(email)) {
            $("#email_error_message").html("El email no es válido")
            $("#email_error_message").show();
            $("#edit-email").css("border", "2px solid #F90A0A");
            error_email = true;
        } else {
            $("#email_error_message").hide();
            $("#edit-email").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_password() {
        var pass = $("#edit-password").val().trim();

        if (pass.length < 1) {
            $("#password_error_message").html("Favor de ingresar una contraseña")
            $("#password_error_message").show();
            $("#edit-password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/[0-9]/)) {
            $("#password_error_message").html("La contraseña debe contener al menos un número")
            $("#password_error_message").show();
            $("#edit-password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/[A-Z]/)) {
            $("#password_error_message").html("La contraseña debe contener al menos una mayúscula")
            $("#password_error_message").show();
            $("#edit-password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/([°|¬!"#$%&/()=?¡'¿¨*\]´+}~`{[^;:_,.\-<>@\\])/)) {
            $("#password_error_message").html("La contraseña debe contener al menos un carácter especial")
            $("#password_error_message").show();
            $("#edit-password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (pass.length < 8) {
            $("#password_error_message").html("La contraseña debe contener al menos 8 caracteres")
            $("#password_error_message").show();
            $("#edit-password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else {
            $("#password_error_message").hide();
            $("#edit-password").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_confirm_password() {
        var pass = $("#edit-password").val().trim();
        var pass2 = $("#retype-password").val().trim();

        if (pass2.length < 1) {
            $("#confirm_password_error_message").html("Favor de confirmar contraseña")
            $("#confirm_password_error_message").show();
            $("#retype-password").css("border", "2px solid #F90A0A");
            error_confirm_password = true;
        } else if (pass2 !== pass) {
            $("#confirm_password_error_message").html("La contraseña no coincide")
            $("#confirm_password_error_message").show();
            $("#retype-password").css("border", "2px solid #F90A0A");
            error_confirm_password = true;
        } else {
            $("#confirm_password_error_message").hide();
            $("#retype-password").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    $("#editProfile").on("submit", function () {

        event.preventDefault();

        error_fname = false;
        error_sname = false;
        error_gender = false;
        error_birthday = false;
        error_email = false;
        error_password = false;
        error_confirm_password = false;
        error_susername = false;
        error_mod = false;

        check_fname();
        check_sname();
        check_gender();
        check_birthday();
        check_email();
        check_password();
        check_confirm_password();
        check_confirm_password();
        check_fusername();
        check_mod();

        if (error_mod === false && error_fusername === false && error_fname === false && error_sname === false && error_gender === false && error_birthday === false && error_email === false && error_password === false && error_confirm_password === false) {

            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

            const userUpdate = {
                idUser: " ",
                editName: $('#edit-name').val().trim(),
                editLastname: $('#edit-last-name').val().trim(),
                editGender: $('#edit-gender').val().trim(),
                editBirthday: $('#edit-birthday').val().trim(),
                editEmail: $('#edit-email').val().trim(),
                editPassword: $('#edit-password').val().trim(),
                editFechaModificacion: formattedDate,
                editUsername: $('#edit-username').val().trim(),
                editMod: $('#edit-mod').val().trim(),
            };

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/User/userUpdate.php", true);
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
                            title: 'El usuario se ha editado con éxito',
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

            //Enviarlo en formato JSON
            xhr.send(JSON.stringify(userUpdate));


            return true;
        } else {
            $("#modal_error_message").html("Por favor llene correctamente todos los campos")
            $("#modal_error_message").show();
            return false;
        }

    })


    $("#Upload").on("change", function () {
        $('#preview-img').hide();
        $('#img-holder').show();
        $("#photo_error_message").hide();
        $("#Upload").css("border", "1px solid #dee2e6");

        if (typeof (FileReader) != "undefined") {

            var reader = new FileReader();
            if (reader.onload) {

            }
            reader.onload = function (e) {
                console.log(e);
                $('#preview-img').show();
                $('#preview-img').attr('src', e.target.result);
                $('#img-holder').hide();

            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }

    });

    const submitBtnImage = document.querySelector('#save-btn');
    submitBtnImage.addEventListener('click', function () {

        event.preventDefault();


        alert('clic');
        error_photo = false;

        var file = document.getElementById("Upload");

        if (file.files.length == 0) {
            error_photo = true;
        }

        if (error_photo === false) {

            var formData = new FormData();

            const fileInput = document.getElementById('Upload');
            const selectedFile = fileInput.files[0];

            // Muestra el objeto fileInput en un alert
            alert("fileInput: " + fileInput);
            // Agregar una alerta para ver las propiedades del objeto File
            alert("Nombre de archivo: " + selectedFile.name);
            alert("Tipo de archivo: " + selectedFile.type);
            alert("Tamaño del archivo: " + selectedFile.size + " bytes");

            formData.append('idUser', " ");
            formData.append('archivo', selectedFile);

            // Acceder al valor de 'archivo' después de asignarlo
            const archivoValue = formData.get('archivo');

            // Imprimir el valor en un alert
            alert("Valor de 'archivo': " + archivoValue);


            const xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "../controllers/User/ImageUserUpdate.php", true);
            xhr2.onreadystatechange = function () {
                try {
                    if (xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200) {
                        let res = JSON.parse(xhr2.response);
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
                    console.error(xhr2.response);

                }


            };

            //Enviarlo en formato JSON
            xhr2.send(JSON.stringify(formData));

        } else {

            $("#photo_error_message").html("Debe seleccionar una foto")
            $("#photo_error_message").show();
            $("#Upload").css("border", "2px solid #F90A0A");

        }
    });

    /* $("#change-photo-form").on("submit", function () {

        event.preventDefault();

        error_photo = false;

        var file = document.getElementById("Upload");

        if (file.files.length == 0) {
            error_photo = true;
        }

        if (error_photo === false) {


            imagen = $('#Upload')[0].files[0];

            var formData = new FormData();

            const fileInput = document.getElementById('Upload');
            const selectedFile = fileInput.files[0];
            formData.append('idUser', " ");
            formData.append('ImagenUnpload', selectedFile);
            
            const xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "../controllers/User/ImageUserUpdate.php", true);
            xhr2.onreadystatechange = function () {
                try {
                    if (xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200) {
                        let res = JSON.parse(xhr2.response);
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
                    console.error(xhr2.response);

                }

                
            };

             //Enviarlo en formato JSON
             xhr2.send(JSON.stringify(formData));
            return true;
        } else {

            $("#photo_error_message").html("Debe seleccionar una foto")
            $("#photo_error_message").show();
            $("#Upload").css("border", "2px solid #F90A0A");
            return false;
        }

    }) */
});

function validateDate(date) {

    var today = new Date();
    var birthday = new Date(date);
    if (birthday > today || birthday.getFullYear() < 1903) {
        return true;
    } else {
        return false;
    }
};