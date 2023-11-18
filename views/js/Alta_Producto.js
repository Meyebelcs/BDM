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

  function validarFormularioStock() {
      // Agrega tus validaciones aquí si es necesario
      return true; // Envía el formulario si todas las validaciones pasan
  }

  //----------------------------Agrega nueva opcion de imagen------------------------------//
  var contadorImagenesStock = 1;
  var contadorImagenesCotizacion = 1;

  document.getElementById('imagenStock').addEventListener('change', function() {
      agregarNuevoCampoImagen('formProducto', 'imagenStock', contadorImagenesStock++);
  });

  document.getElementById('imagenCotizacion').addEventListener('change', function() {
      agregarNuevoCampoImagen('formCotizacion', 'imagenCotizacion', contadorImagenesCotizacion++);
  });

  function agregarNuevoCampoImagen(formId, inputId, contador) {
      // Obtener el formulario actual
      var formulario = document.getElementById(formId);

      // Crear un nuevo input de imagen
      var nuevoInputImagen = document.createElement('input');
      nuevoInputImagen.type = 'file';
      nuevoInputImagen.id = inputId + '_' + contador;
      nuevoInputImagen.name = inputId + '[]';
      nuevoInputImagen.accept = 'image/*';
      nuevoInputImagen.multiple = true;

      // Agregar el nuevo input al formulario
      formulario.appendChild(nuevoInputImagen);
  }
  //---------------------------------------------------------------------------------------//
});
