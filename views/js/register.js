const $modal = $('#miModal');

function mostrarModalidad() {
    var rolSelect = document.getElementById("rol");
    var modalidadDiv = document.getElementById("modalidadDiv");

    if (rolSelect.value === "Comprador") {
        modalidadDiv.style.display = "block";
    } else {
        modalidadDiv.style.display = "none";
    }
}

//--------------------------VALIDACIONES--------------------
$(function () {

    $('#OK').click(function () {
        $('#miModal').css('display', 'none');
        window.location.href = "./login.php";
    });


    $("#fname_error_message").hide();
    $("#sname_error_message").hide();
    $("#gender_error_message").hide();
    $("#rol_error_message").hide();
    $("#birthday_error_message").hide();
    $("#modalidad_error_message").hide();
    $("#email_error_message").hide();
    $("#password_error_message").hide();
    $("#confirm_password_error_message").hide();
    $("#photo_error_message").hide();
    $("#username_error_message").hide();

    var error_fname = false;
    var error_sname = false;
    var error_gender = false;
    var error_rol = false;
    var error_birthday = false;
    var error_modalidad = false;
    var error_email = false;
    var error_password = false;
    var error_confirm_password = false;
    var error_photo = false;
    var error_username = false;

    $("#name").on("keyup", function () {
        check_fname();
    });
    $("#last-name").on("keyup", function () {
        check_sname();
    });
    $("#gender").on("click", function () {
        check_gender();
    });
    $("#rol").on("click", function () {
        check_rol();
    });
    $("#birthday").on("change", function () {
        check_birthday();
    });
    $("#mod").on("change", function () {
        check_modalidad();
    });
    $("#email").on("keyup", function () {
        check_email();
    });
    $("#password").on("keyup", function () {
        check_password();
        check_confirm_password();
    });
    $("#retype-password").on("keyup", function () {
        check_confirm_password();

    });
    $("#profile-picture").on("change", function () {
        check_photo();
    });
    $("#username").on("change", function () {
        check_username();
    });

    function check_fname() {
        var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
        var fname = $("#name").val().trim();

        if (fname.length < 1) {
            $("#fname_error_message").html("Favor de ingresar el nombre")
            $("#fname_error_message").show();
            $("#name").css("border", "2px solid #F90A0A");
            error_fname = true;
        } else if (!pattern.test(fname)) {
            $("#fname_error_message").html("El campo contiene caracteres invalidos")
            $("#fname_error_message").show();
            $("#name").css("border", "2px solid #F90A0A");
            error_fname = true;
        } else {
            $("#fname_error_message").hide();
            $("#name").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_gender() {
        var gender = $("#gender").val().trim();

        if (gender === "") {
            $("#gender_error_message").html("Seleccione el género")
            $("#gender_error_message").show();
            $("#gender").css("border", "2px solid #F90A0A");
            error_gender = true;
        } else {
            $("#gender_error_message").hide();
            $("#gender").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_rol() {
        var rol = $("#rol").val().trim();

        if (rol === "") {
            $("#rol_error_message").html("Seleccione un rol")
            $("#rol_error_message").show();
            $("#rol").css("border", "2px solid #F90A0A");
            error_rol = true;
        } else {
            $("#rol_error_message").hide();
            $("#rol").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_modalidad() {
        var mod = $("#mod").val().trim();

        if (mod === "") {
            $("#modalidad_error_message").html("Seleccione una modalidad")
            $("#modalidad_error_message").show();
            $("#mod").css("border", "2px solid #F90A0A");
            error_modalidad = true;
        } else {
            $("#modalidad_error_message").hide();
            $("#rol").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_photo() {
        var photo = document.getElementById("profile-picture").files.length;

        if (photo === 0) {
            $("#photo_error_message").html("Debe seleccionar una foto")
            $("#photo_error_message").show();
            $("#profile-picture").css("border", "2px solid #F90A0A");
            error_photo = true;
        } else {
            $("#photo_error_message").hide();
            $("#profile-picture").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_birthday() {
        var fecha = $("#birthday").val();

        if (fecha.length < 1) { //Valida que no esté vacío
            $("#birthday_error_message").html("Favor de seleccionar una fecha")
            $("#birthday_error_message").show();
            $("#birthday").css("border", "2px solid #F90A0A");
            error_birthday = true;
        } else if (validateDate(fecha)) {
            $("#birthday_error_message").html("La fecha no es válida")
            $("#birthday_error_message").show();
            $("#birthday").css("border", "2px solid #F90A0A");
            error_birthday = true;
        } else {
            $("#birthday_error_message").hide();
            $("#birthday").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_sname() {
        var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
        var sname = $("#last-name").val().trim();

        if (sname.length < 1) {
            $("#sname_error_message").html("Favor de ingresar apellidos")
            $("#sname_error_message").show();
            $("#last-name").css("border", "2px solid #F90A0A");
            error_sname = true;
        } else if (!pattern.test(sname)) {
            $("#sname_error_message").html("El campo contiene caracteres invalidos")
            $("#sname_error_message").show();
            $("#last-name").css("border", "2px solid #F90A0A");
            error_sname = true;
        } else {
            $("#sname_error_message").hide();
            $("#last-name").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_email() {
        var pattern = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        var email = $("#email").val().trim();

        if (email.length < 1) {
            $("#email_error_message").html("Favor de ingresar un email")
            $("#email_error_message").show();
            $("#email").css("border", "2px solid #F90A0A");
            error_email = true;
        } else if (!pattern.test(email)) {
            $("#email_error_message").html("El email no es válido")
            $("#email_error_message").show();
            $("#email").css("border", "2px solid #F90A0A");
            error_email = true;
        } else {
            $("#email_error_message").hide();
            $("#email").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_password() {
        var pass = $("#password").val().trim();

        if (pass.length < 1) {
            $("#password_error_message").html("Favor de ingresar una contraseña")
            $("#password_error_message").show();
            $("#password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/[0-9]/)) {
            $("#password_error_message").html("La contraseña debe contener al menos un número")
            $("#password_error_message").show();
            $("#password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/[A-Z]/)) {
            $("#password_error_message").html("La contraseña debe contener al menos una mayúscula")
            $("#password_error_message").show();
            $("#password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (!pass.match(/([°|¬!"#$%&/()=?¡'¿¨*\]´+}~`{[^;:_,.\-<>@\\])/)) {
            $("#password_error_message").html("La contraseña debe contener al menos un carácter especial")
            $("#password_error_message").show();
            $("#password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else if (pass.length < 8) {
            $("#password_error_message").html("La contraseña debe contener al menos 8 caracteres")
            $("#password_error_message").show();
            $("#password").css("border", "2px solid #F90A0A");
            error_password = true;
        } else {
            $("#password_error_message").hide();
            $("#password").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function check_confirm_password() {
        var pass = $("#password").val().trim();
        var pass2 = $("#retype-password").val().trim();

        if (pass2.length < 1) {
            $("#confirm_password_error_message").html("Favor de confirmar la contraseña")
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

    function check_username() {
        var susername = $("#username").val().trim();

        if (susername.length < 1) {
            $("#username_error_message").html("Favor de ingresar un nombre de usuario")
            $("#username_error_message").show();
            $("#username").css("border", "2px solid #F90A0A");
            error_username = true;
        } else {
            $("#username_error_message").hide();
            $("#username").css("border", "2px solid #34f458", "margin-bottom", "0px");
        }
    }

    function showModal(message) {
        var tituloModal = document.querySelector('#miModal h2');
        tituloModal.textContent = message;
        $modal.css('display', 'grid');
    }

    //--------------------------REGISTRO DE USUARIO--------------------

    const submitBtn = document.querySelector('#btn-register');
    submitBtn.addEventListener('click', function () {

        error_fname = false;
        error_sname = false;
        error_gender = false;
        error_rol = false;
        error_photo = false;
        error_birthday = false;
        error_email = false;
        error_password = false;
        error_confirm_password = false;
        error_username = false;

        check_fname();
        check_sname();
        check_gender();
        check_rol();
        check_photo();
        check_birthday();
        check_email();
        check_password();
        check_confirm_password();
        check_confirm_password();
        check_username();

        var rol = $("#rol").val().trim();
        var varmod = "";
        if (rol === "Comprador") {
            check_modalidad();
            if (error_modalidad === true) {
                return;
            }
            varmod = $("#mod").val().trim();
        }
        if (rol === "Vendedor") {
            varmod = 'Público';
        }

        if (error_username === false && error_fname === false && error_sname === false && error_gender === false && error_rol === false && error_photo === false && error_birthday === false && error_email === false && error_password === false && error_confirm_password === false) {


            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

            const userRegister = {
                idStatus:'1',
                Email: $("#email").val().trim(),
                Username: $("#username").val().trim(),
                Contraseña: $("#password").val().trim(),
                Rol: $("#rol").val().trim(),
                Imagen: $("#profile-picture").val().trim(),
                Nombres: $("#name").val().trim(),
                Apellidos: $("#last-name").val().trim(),
                Fecha_nacimiento: $("#birthday").val().trim(),
                Sexo: $("#gender").val().trim(),
                Modo: varmod,
                Fecha_modificación: formattedDate,
                Fecha_registro: formattedDate
            };

            const xhr = new XMLHttpRequest();

            xhr.open("POST", "../controllers/register.php", true);
            xhr.onreadystatechange = function () {
                try {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        let res = JSON.parse(xhr.response);
                        if (res.success !== true) {
    
                            alert(res.msg);
    
                            return;
                        }
    
                        // Éxito...
                        showModal("Se registró correctamente");
    
                        console.log(res.msg);
                    }
                } catch (error) {
                    // Imprimir error del servidor
                    console.error(xhr.response);
                }
            };

            //Enviarlo en formato JSON
            xhr.send(JSON.stringify(userRegister));

        }
        else {
            $("#modal_error_message").html("Por favor llene correctamente todos los campos")
            $("#modal_error_message").show();

        }
    });

    function validateDate(date) {

        var today = new Date();
        var birthday = new Date(date);
        if (birthday > today || birthday.getFullYear() < 1903) {
            return true;
        } else {
            return false;
        }
    }

});
