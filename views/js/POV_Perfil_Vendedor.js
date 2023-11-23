/*----------- Switch Cotizacion Producto ----------*/
var estado = 'Stock';
$(document).ready(function () {

  $('.productosCotizacion').hide();
  $('.productosStock').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Cotizaciones');
      $('.productosStock').hide();
      $('.productosCotizacion').show();
      estado = 'Cotizacion';
      limpiarInputs();
      filtro();
    } else {
      $('#switchText').text('Productos');
      $('.productosCotizacion').hide();
      $('.productosStock').show();
      estado = 'Stock';
      limpiarInputs();
      filtro();
    }
  });

  function limpiarInputs() {
    // Obtener referencias a los inputs
    var fechaInicialInput = document.getElementById('fechaInicial');
    var horaInput = document.getElementById('hora');
    var categoriaSelect = document.getElementById('categoria');
    var nombreProductoInput = document.getElementById('nombreProducto');
    var calificacionSelect = document.getElementById('calificacion');

    // Limpiar los valores de los inputs
    fechaInicialInput.value = '';
    horaInput.value = '';
    categoriaSelect.value = '';
    nombreProductoInput.value = '';
    calificacionSelect.value = '';
  }

  //--------------FILTROOO-------------------------

  // Captura cambios en los campos con la clase 'buscar'
  $('.buscar').change(function () {
    filtro();
  });

  function filtro() {
    var fecha = $('#fechaInicial').val() ?? null;
    var hora = $('#hora').val() ?? null;
    var idcategoria = $('#categoria').val() ?? '0';
    var nombreProducto = $('#nombreProducto').val() ?? null;
    var calificacion = $('#calificacion').val() ?? '0';

    const formData = new FormData();
    formData.append('fecha', fecha);
    formData.append('hora', hora);
    formData.append('idcategoria', idcategoria);
    formData.append('nombreProducto', nombreProducto);
    formData.append('calificacion', calificacion);
    formData.append('action', estado);

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
          /*    console.log('tipoooo' + res.tipo); */
          if (res.tipo === 'Stock') {
            // Éxito...
            const productosContainer = document.getElementById('productosStockCard');
            productosContainer.innerHTML = ''; // Limpiar contenido existente

            if (res.productosBD && res.productosBD.length > 0) {
              res.productosBD.forEach(producto => {
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
                              ${producto.Categorias.map(categoria => `<small class="card-text mb-1"><strong> #${categoria}</strong></small>`).join('')}
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
          } else {
            //cotizacion
            // Éxito...
            const cotizacionesContainer = document.getElementById('productosCotizacionCard');
            cotizacionesContainer.innerHTML = ''; // Limpiar contenido existente

            if (res.productosBD && res.productosBD.length > 0) {
              res.productosBD.forEach(cotizacion => {
                const nuevoCotizacion = document.createElement('div');
                nuevoCotizacion.className = 'card border mb-5';
                nuevoCotizacion.style.width = '50rem';
                nuevoCotizacion.innerHTML = `
                  <div class="card-body">
                      <div class="d-flex justify-content-center mb-3" style="background: #B7CBBF; padding:1rem">
                      ${cotizacion.Archivos ? cotizacion.Archivos.map(archivo => `<img src="data:image/jpeg;base64,${archivo}" class="card-img card-img-top mx-auto" alt="${cotizacion.Nombre}" style="width: 20%;">`).join('')
                    : 'no hay datos'
                  }
                      </div>
                      <h5 class="card-title mb-1">${cotizacion.Nombre}</h5>
                      <small class="card-text mb-1">${cotizacion.Descripción} <br></small>
                      <!-- Muestra las categorías -->
                      <div class="categorias">
                          ${cotizacion.Categorias.map(categoria => `<small class="card-text mb-1"><strong> #${categoria}</strong></small>`).join('')}
                      </div>
                      <!-- Resto del contenido del producto -->
                      <hr class="mt-2">
                      <p class="card-text mb-1">Cantidad Vendida: ${cotizacion.CantidadVendida}</p>
                      <p class="card-text mb-1">Total de Ingresos: $ ${cotizacion.TotalIngresos}</p>
                      <p class="card-text mb-1">Fecha de publicación: ${cotizacion.Fecha}</p>
                      <p class="card-text mb-1">Hora de publicación: ${cotizacion.Hora}</p>
                      <div class="calificacion pb-2">
                          ${'<i class="bi bi-star-fill"></i>'.repeat(Math.floor(cotizacion.PromedioCalificacion))}
                          ${'<i class="bi bi-star"></i>'.repeat(5 - Math.floor(cotizacion.PromedioCalificacion))}
                      </div>
                      <hr class="mt-2">
                      <a href="Detalle_producto.php?idProductoIndex=${cotizacion.idProducto}" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                  </div>
                `;
                cotizacionesContainer.appendChild(nuevoCotizacion);
              });
            } else {
              const mensajeNoCotizaciones = document.createElement('div');
              mensajeNoCotizaciones.className = 'col border mx-3 mb-6 mt-6';
              mensajeNoCotizaciones.style.width = '20rem';
              mensajeNoCotizaciones.style.background = '#B7CBBF';
              mensajeNoCotizaciones.style.margin = '5rem';
              mensajeNoCotizaciones.innerText = 'Aún no hay cotizaciones registradas';
              cotizacionesContainer.appendChild(mensajeNoCotizaciones);
            }

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

  }

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

