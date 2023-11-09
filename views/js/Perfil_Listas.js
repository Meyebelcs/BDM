$(document).ready(function() {

    $('.PerfilPrivado').hide();
    $('.PerfilPublico').show();

  $('#switchInput').change(function() {
      if ($(this).is(':checked')) {
          $('#switchText').text('Perfil Privado');
          $('.PerfilPublico').hide();
          $('.PerfilPrivado').show();
      } else {
          $('#switchText').text('Perfil Público');
          $('.PerfilPrivado').hide();
          $('.PerfilPublico').show();
      }
  });
});


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


