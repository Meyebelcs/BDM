$(function () {
  $("#card_name_error_message").hide();
  $("#curp_error_message").hide();
  $("#card_number_error_message").hide();
  $("#card_cvv_error_message").hide();
  $("#expiration_date_error_message").hide();

  var error_name = false;
  var error_curp = false;
  var error_number = false;
  var error_cvv = false;
  var error_exp_date = false;

  $("#card-name-input").on("keyup", function () {
    check_name();
  });
  $("#curp-input").on("keyup", function () {
    check_curp();
  });
  $("#card-number-input").on("keyup", function () {
    check_number();
  });
  $("#card-cvv-input").on("keyup", function () {
    check_cvv();
  });
  $("#exp-month").on("keyup", function () {
    check_month();
  });
  $("#exp-year").on("keyup", function () {
    check_year();
  });

  $("#card-paymethod").on("click", function () {
    $("#pay-btn").css("display", "block");
  });

  function check_name() {
    var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
    var name = $("#card-name-input").val().trim();

    if (name.length < 1) { //Valida que no esté vacío
      $("#card_name_error_message").html("Favor de ingresar el nombre")
      $("#card_name_error_message").show();
      $("#card-name-input").css("border", "2px solid #F90A0A");
      error_name = true;
    } else if (!pattern.test(name)) {//Valida que solo contenga caracteres del alfabeto español
      $("#card_name_error_message").html("El campo contiene caracteres invalidos")
      $("#card_name_error_message").show();
      $("#card-name-input").css("border", "2px solid #F90A0A");
      error_name = true;
    } else {
      $("#card_name_error_message").hide();
      $("#card-name-input").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  function check_curp() {
    var pattern = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
    var curp = $("#curp-input").val().trim();

    if (curp.length < 1) { //Valida que no esté vacío
      $("#curp_error_message").html("Favor de ingresar el CURP")
      $("#curp_error_message").show();
      $("#curp-input").css("border", "2px solid #F90A0A");
      error_curp = true;
    } else if (!pattern.test(curp)) {//Valida que solo contenga caracteres del alfabeto español
      $("#curp_error_message").html("El CURP no es válido")
      $("#curp_error_message").show();
      $("#curp-input").css("border", "2px solid #F90A0A");
      error_curp = true;
    } else {
      $("#curp_error_message").hide();
      $("#curp-input").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  function check_number() {
    var pattern = /^[0-9]*$/;
    var number = $("#card-number-input").val().trim();
    if (number.length < 1) { //Valida que no esté vacío
      $("#card_number_error_message").html("Favor de ingresar el número de tarjeta")
      $("#card_number_error_message").show();
      $("#card-number-input").css("border", "2px solid #F90A0A");
      error_number = true;
    } else if (!pattern.test(number)) {//Valida que solo contenga caracteres del alfabeto español
      $("#card_number_error_message").html("Este campo solo debe contener números")
      $("#card_number_error_message").show();
      $("#card-number-input").css("border", "2px solid #F90A0A");
      error_number = true;
    } else if (!(number.length > 7 && number.length < 20)) {//Valida que solo contenga caracteres del alfabeto español
      $("#card_number_error_message").html("El número de tarjeta no és válido")
      $("#card_number_error_message").show();
      $("#card-number-input").css("border", "2px solid #F90A0A");
      error_number = true;
    } else {
      $("#card_number_error_message").hide();
      $("#card-number-input").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  function check_cvv() {
    var cvv = $("#card-cvv-input").val().trim();

    if (cvv.length < 1) { //Valida que no esté vacío
      $("#card_cvv_error_message").html("Favor de ingresar el CVV")
      $("#card_cvv_error_message").show();
      $("#card-cvv-input").css("border", "2px solid #F90A0A");
      error_cvv = true;
    } else if (cvv.length < 3 || cvv.length > 4) {//Valida que no tenga espacios
      $("#card_cvv_error_message").html("El cvv no es válido")
      $("#card_cvv_error_message").show();
      $("#card-cvv-input").css("border", "2px solid #F90A0A");
      error_cvv = true;
    } else {
      $("#card_cvv_error_message").hide();
      $("#card-cvv-input").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  function check_month() {
    var month = $("#exp-month").val();
    var year = $("#exp-year").val();
    var patternMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;

    if (month.length < 1) { //Valida que no esté vacío
      $("#expiration_date_error_message").html("El campo mes no debe estar vacío");
      $("#expiration_date_error_message").show();
      $("#exp-month").css("border", "2px solid #F90A0A");
      error_exp_date = true;
    } else if (!patternMonth.test(month)) {//Valida que solo contenga caracteres del alfabeto español
      $("#expiration_date_error_message").html("El mes no es válido");
      $("#expiration_date_error_message").show();
      $("#exp-month").css("border", "2px solid #F90A0A");
      error_exp_date = true;
    } else if (year === "2023" && month < 2) {//Valida que solo contenga caracteres del alfabeto español
      $("#expiration_date_error_message").html("La fecha no es válida")
      $("#expiration_date_error_message").show();
      $("#exp-month").css("border", "2px solid #F90A0A");
      $("#exp-year").css("border", "2px solid #F90A0A");
      error_sname = true;
    } else {
      $("#expiration_date_error_message").hide();
      $("#exp-month").css("border", "2px solid #34f458", "margin-bottom", "0px");
      $("#exp-year").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  function check_year() {
    var month = $("#exp-month").val();
    var year = $("#exp-year").val();

    var patternYear = /^2023|2024|2025|2026|2027|2028|2029|2030|2031$/;

    if (year.length < 1) {//Valida que solo contenga caracteres del alfabeto español
      $("#expiration_date_error_message").html("Favor de ingresar el año")
      $("#expiration_date_error_message").show();
      $("#exp-year").css("border", "2px solid #F90A0A");
      error_exp_date = true;
    } else if (!patternYear.test(year)) {//Valida que solo contenga caracteres del alfabeto español
      $("#expiration_date_error_message").html("El año no es valído")
      $("#expiration_date_error_message").show();
      $("#exp-year").css("border", "2px solid #F90A0A");
      error_exp_date = true;
    } else if (year === "2023" && month < 2) {//Valida que solo contenga caracteres del alfabeto español
      $("#expiration_date_error_message").html("La fecha no es válida")
      $("#expiration_date_error_message").show();
      $("#exp-month").css("border", "2px solid #F90A0A");
      $("#exp-year").css("border", "2px solid #F90A0A");
      error_exp_date = true;
    } else {
      $("#expiration_date_error_message").hide();
      $("#exp-year").css("border", "2px solid #34f458", "margin-bottom", "0px");
      $("#exp-month").css("border", "2px solid #34f458", "margin-bottom", "0px");
    }
  }

  
  $("#payment-form").on('submit', function () {
    var accion = '';
    event.preventDefault();
    if ($('#paypal-paymethod').is(':checked')) {

      accion = 'paypal';
      altaventa(accion);
    } else {
      accion = 'tarjeta'
    }
    error_name = false;
    error_curp = false;
    error_number = false;
    error_cvv = false;
    error_exp_date = false;

    check_name();
    check_curp();
    check_number();
    check_cvv();
    check_month();
    check_year();


    if (error_name === false && error_curp === false && error_number === false && error_cvv === false && error_exp_date === false) {

      altaventa(accion);


      return false;
    } else {
      $("#general_error_message").html("Por favor llene correctamente todos los campos")
      $("#general_error_message").show();
      return false;
    }

  })

})

function validateDate(date) {

  var today = new Date();
  var birthday = new Date(date);
  if (birthday > today || birthday.getFullYear() < 1903) {
    return true;
  } else {
    return false;
  }
}

function altaventa(accion) {
  // Acceder al valor del campo oculto que contiene los idCarritos
  var idCarritos = $('#idCarritosInput').val().split(',');

  // Ahora idCarritos es un array que puedes utilizar
  console.log(idCarritos);
  const now = new Date();
  const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

  const formData = new FormData();
  formData.append('accion', accion);
  formData.append('fechaHrRegistro', formattedDate);
  // Agregar cada idCarrito al FormData
  for (var i = 0; i < idCarritos.length; i++) {
    formData.append('idCarrito[]', idCarritos[i]);
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controllers/Venta/Alta_Venta.php", true);
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
            window.location.href = "./home.php";

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
  }

  xhr.send(formData);
}