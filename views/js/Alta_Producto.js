$(document).ready(function() {

    $('.productosCotizacion').hide();
    $('.productosStock').show();

  $('#switchInput').change(function() {
      if ($(this).is(':checked')) {
          $('#switchText').text('Crear Cotización');
          $('.productosStock').hide();
          $('.productosCotizacion').show();
      } else {
          $('#switchText').text('Añadir Productos');
          $('.productosCotizacion').hide();
          $('.productosStock').show();
      }
  });
});

// Obtén referencias a los elementos del DOM
const toggleMenuButton = document.getElementById('toggleMenu');
const menuContainer = document.getElementById('menuContainer');

// Agrega un evento clic al botón de alternar menú
toggleMenuButton.addEventListener('click', function () {
  // Verifica si el menú está oculto
  if (menuContainer.style.display === 'none' || menuContainer.style.display === '') {
    // Muestra el menú
    menuContainer.style.display = 'block';
  } else {
    // Oculta el menú
    menuContainer.style.display = 'none';
  }
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

document.getElementById('imagenCotizacion').addEventListener('change', function () {
  mostrarImagenesSeleccionadas(this, 'previewCotizacion');
});

function mostrarImagenesSeleccionadas(input, previewId) {
  var preview = document.getElementById(previewId);

  if (input.files && input.files.length > 0) {
      for (var i = 0; i < input.files.length; i++) {
          var reader = new FileReader();

          reader.onload = function (e) {
              var imagen = document.createElement('img');
              imagen.src = e.target.result;
              imagen.style.maxWidth = '100px'; // Tamaño máximo de la imagen en la vista previa
              imagen.style.marginRight = '10px'; // Espacio entre imágenes
              preview.appendChild(imagen);
          };

          reader.readAsDataURL(input.files[i]);
      }
  }
}

function validarFormularioCotizacion() {
  // Agrega tus validaciones aquí si es necesario
  return true; // Envía el formulario si todas las validaciones pasan
}

document.getElementById('imagenStock').addEventListener('change', function () {
  mostrarImagenesSeleccionadas(this, 'previewStock');
});

function mostrarImagenesSeleccionadas(input, previewId) {
  var preview = document.getElementById(previewId);

  if (input.files && input.files.length > 0) {
      for (var i = 0; i < input.files.length; i++) {
          var reader = new FileReader();

          reader.onload = function (e) {
              var imagen = document.createElement('img');
              imagen.src = e.target.result;
              imagen.style.maxWidth = '100px'; // Tamaño máximo de la imagen en la vista previa
              imagen.style.marginRight = '10px'; // Espacio entre imágenes
              preview.appendChild(imagen);
          };

          reader.readAsDataURL(input.files[i]);
      }
  }
}

function validarFormularioStock() {
  // Agrega tus validaciones aquí si es necesario
  return true; // Envía el formulario si todas las validaciones pasan
}