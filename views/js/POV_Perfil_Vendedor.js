/*----------- Switch Cotizacion Producto ----------*/

$(document).ready(function () {

  $('.productosCotizacion').hide();
  $('.productosStock').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Cotizaciones');
      $('.productosStock').hide();
      $('.productosCotizacion').show();
    } else {
      $('#switchText').text('Productos');
      $('.productosCotizacion').hide();
      $('.productosStock').show();
    }
  });

  //--------------FILTROOO-------------------------

  // Captura cambios en los campos con la clase 'buscar'
  $('.buscar').change(function () {
    // Recoge los valores de los campos
    var fecha = $('#fechaInicial').val() ?? null;
    var hora = $('#hora').val() ?? null;
    var idcategoria = $('#categoria').val() ?? '0';
    var nombreProducto = $('#nombreProducto').val() ?? null;
    var calificacion = $('#calificacion').val() ?? '0';

    console.log('Fecha:', fecha);
    console.log('Hora:', hora);
    console.log('ID Categoría:', idcategoria);
    console.log('Nombre Producto:', nombreProducto);
    console.log('Calificación:', calificacion);

    const formData = new FormData();
    formData.append('fecha', fecha);
    formData.append('hora', hora);
    formData.append('idcategoria', idcategoria);
    formData.append('nombreProducto', nombreProducto);
    formData.append('calificacion', calificacion);
    formData.append('action', 'Stock');

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '../controllers/Reportes/POV_VendedorFiltro.php', true);
    xhr.onreadystatechange = function () {
      try {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          let res = JSON.parse(xhr.response);
          if (res.success !== true) {
            Swal.fire({
              title: 'Error',
              text: res.msg,
              icon: 'error',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#F47B8F'
            });
            return;
          }

          // Éxito...
          const productosContainer = document.getElementById('productosStockCard');
          productosContainer.innerHTML = ''; // Limpiar contenido existente

          if (res.productosStock && res.productosStock.length > 0) {
            res.productosStock.forEach(producto => {
              const nuevoProducto = document.createElement('div');
              nuevoProducto.className = 'col border mx-3 mb-3';
              nuevoProducto.style.width = '20rem';
              nuevoProducto.innerHTML = `
              <div class="card" style="width: 100%;">
                  <img src="data:image/jpeg;base64,${producto.Imagen}" class="card-img card-img-top" alt="${producto.Nombre}" style="width: 300px; height: 300px;">
                  <div class="card-body">
                      <h5 class="card-title mb-1">${producto.Nombre}</h5>
                      <small class="card-text mb-1">${producto.Descripción}</small>
                      <!-- Muestra las categorías -->
                      <div class="categorias">
                          ${producto.Categorias.map(categoria => `<small class="card-text mb-1"><strong># ${categoria}</strong></small>`).join('')}
                      </div>
                      <!-- Resto del contenido del producto -->
                      <hr class="mt-2">
                      <p class="card-text mb-1">Precio: $
                      ${producto.Precio}
                      </p>
                      <p class="card-text mb-1">Cantidad Vendida:
                      ${producto.CantidadVendida}
                      </p>
                      <p class="card-text mb-1">Inventario:
                      ${producto.Inventario}
                      </p>
                      <p class="card-text mb-1">Total de Ingresos: $
                      ${producto.TotalIngresos}
                      </p>
                      <p class="card-text mb-1">Fecha de publicación:
                      ${producto.Fecha}
                      </p>
                      <p class="card-text mb-1">Hora de publicación:
                      ${producto.Hora}
                      </p>

                      <div class="calificacion pb-2">
                      ${'<i class="bi bi-star-fill"></i>'.repeat(Math.floor(producto.PromedioCalificacion))}
                      ${'<i class="bi bi-star"></i>'.repeat(5 - Math.floor(producto.PromedioCalificacion))}
                      </div>

                      <a href="Detalle_producto.php?idProductoIndex=${producto.idProducto}"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
              </div>
          `;
              productosContainer.appendChild(nuevoProducto);
            });
          } else {
            const mensajeNoProductos = document.createElement('div');
            mensajeNoProductos.className = 'col border mx-3 mb-6 mt-6';
            mensajeNoProductos.style.width = '20rem';
            mensajeNoProductos.style.background = '#B7CBBF';
            mensajeNoProductos.style.margin = '5rem';
            mensajeNoProductos.innerText = 'Aún no hay productos registrados';
            productosContainer.appendChild(mensajeNoProductos);
          }

          console.log(res.msg);
        }
      } catch (error) {
        // Imprimir error del servidor
        console.error('Error del servidor:', xhr.response);
        console.error('Estado del servidor:', xhr.status);
        console.error('Texto del estado del servidor:', xhr.statusText);
        console.error('Error JavaScript:', error); // Agrega esta línea para obtener más detalles sobre el error de JavaScript
      }
    };

    // Enviar formData
    xhr.send(formData);
    return false;


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

