/*----------- Switch Cotizacion Producto ----------*/
$(document).ready(function () {

  $('.productosCotizacion').hide();
  $('.productosStock').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Cotizaciones Compradas');
      $('.productosStock').hide();
      $('.productosCotizacion').show();
    } else {
      $('#switchText').text('Productos Comprados');
      $('.productosCotizacion').hide();
      $('.productosStock').show();
    }
  });
});


/*----------- PAGINACION----------*/

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  },
});


