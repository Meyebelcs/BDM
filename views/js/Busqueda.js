$(document).ready(function() {

    $('.productosCotizacion').hide();
    $('.productosStock').show();

  $('#switchInput').change(function() {
      if ($(this).is(':checked')) {
          $('#switchText').text('Busqueda Cotizaciones');
          $('.productosStock').hide();
          $('.productosCotizacion').show();
      } else {
          $('#switchText').text('Busqueda Productos');
          $('.productosCotizacion').hide();
          $('.productosStock').show();
      }
  });
});
