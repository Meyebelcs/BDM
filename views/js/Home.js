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

//------------------------------------------------------------------

// Obtén referencias a los elementos del DOM
const toggleMenuButton = document.getElementById('toggleMenu');
const menuContainer = document.getElementById('menuContainer');
const menu = document.getElementById('btn-menu');

// Agrega un evento clic al botón de alternar menú
toggleMenuButton.addEventListener('click', function () {
  // Verifica si el menú está oculto
  if (menuContainer.style.display === 'none' || menuContainer.style.display === '') {
    // Muestra el menú
    menuContainer.style.display = 'block';
    //toggleMenuButton.textContent = '✖️'; // Cambiar el contenido del botón a ✖️ cuando se abre el menú
  } else {
    // Oculta el menú
    menuContainer.style.display = 'none';
   // toggleMenuButton.textContent = '☰'; // Cambiar el contenido del botón a ☰ cuando se cierra el menú
  }
});


