$(function () {
    const $username = $("#username");
    const $password = $("#password");
    const $usernameError = $("#username_error_message");
    const $passwordError = $("#password_error_message");
    const $modal = $('#miModal');

    const errors = {
        username: true,
        password: true
    };

    function showError($element, errorMessage) {
        $element.html(errorMessage);
        $element.show();
    }

    function hideError($element) {
        $element.hide();
    }

    const xhr = new XMLHttpRequest();
    let status = "status";

    // Oculta los mensajes de error iniciales
    $usernameError.hide();
    $passwordError.hide();

    let OK = false;

    // Evento al escribir en el campo de username
    $username.on("input", function () {
        check_username();
        $("#modal_error_message").hide();
    });

    // Evento al escribir en el campo de contraseña
    $password.on("input", function () {
        check_password();
        $("#modal_error_message").hide();
    });

    // Evento al hacer clic en el botón OK
    $("#OK").on("click", function () {
        OK = true;
    });

    function showModal(message) {
        var tituloModal = document.querySelector('#miModal h2');
        tituloModal.textContent = message;
        $modal.css('display', 'grid');
    }

    // Función para validar el username
    function check_username() {

        var username = $username.val().trim();

        if (username.length === 0) {
            showError($usernameError, "Favor de ingresar el username");
            errors.username = true;
        } else {
            hideError($usernameError);
            errors.username = false;
        }
    }

    // Función para validar la contraseña
    function check_password() {
        var pass = $password.val().trim();

        if (pass.length < 1) {
            showError($passwordError, "Favor de ingresar la contraseña");
            errors.password = true;
        } else {
            hideError($passwordError);
            errors.password = false;
        }
    }

    $(document).ready(function () {
        $('#OK').click(function () {
            if (OK === true) {
                $modal.css('display', 'none');
                OK = false;

                if (status === "login") {
                    window.location.href = "./home.php";
                }
            } else {
                $modal.css('display', 'grid');
            }
        });
    });

    const submitBtn = document.querySelector('#btn_login');
    submitBtn.addEventListener('click', function () {

        if (errors.username || errors.password) {
            $("#modal_error_message").html("Por favor llene correctamente todos los campos");
            $("#modal_error_message").show();
            return false;
        }

        const user = {
            username: $username.val().trim(),
            password: $password.val().trim()
        };

        xhr.open("POST", "../controllers/login.php", true);
        xhr.onreadystatechange = function () {
            try {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    let res = JSON.parse(xhr.response);
                    if (res.success !== true) {

                        showModal("El usuario o la contraseña no son correctos");

                        return;
                    }

                    // Éxito...
                    status = "login";
                    showModal("Se ingresó correctamente");

                    console.log(res.msg);
                }
            } catch (error) {
                // Imprimir error del servidor
                console.error(xhr.response);
                alert(msg);
            }
        };

        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(user));
    });
});
