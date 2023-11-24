$(document).ready(function () {

/*   $('.PerfilPrivado').hide();
  $('.PerfilPublico').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Perfil Privado');
      $('.PerfilPublico').hide();
      $('.PerfilPrivado').show();
    } else {
      $('#switchText').text('Perfil Público');
      $('.PerfilPrivado').hide();
      $('.PerfilPublico').show();
    }
  }); */

  $('.PerfilPrivado').hide();

  $('.productosCotizacion').hide();
  $('.productosStock').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Cotizaciones');
      $('.productosStock').hide();
      $('.productosCotizacion').show();
    } else {
      $('#switchText').text('Productos en Stock');
      $('.productosCotizacion').hide();
      $('.productosStock').show();
    }
  });

  
});


