var estado = 'Stock';

/*----------- Switch Cotizacion Producto ----------*/
$(document).ready(function () {

  $('.productosCotizacion').hide();
  $('.productosStock').show();

  $('#switchInput').change(function () {
    if ($(this).is(':checked')) {
      $('#switchText').text('Cotizaciones Compradas');
      $('.productosStock').hide();
      $('.productosCotizacion').show();
      estado = 'Cotizacion';
      limpiarInputs();
      filtro();
    } else {
      $('#switchText').text('Productos Comprados');
      $('.productosCotizacion').hide();
      $('.productosStock').show();
      estado = 'Stock';
      limpiarInputs();
      filtro();
    }
  });

  const precioInput = document.getElementById('precioProducto');

  precioInput.addEventListener('input', function (event) {
    let precio = event.target.value;
    let regex = /^[0-9]*\.?[0-9]*$/;

    if (regex.test(precio)) {
      // Cambiar el color del borde a verde si es válido
      precioInput.style.border = '1px solid green';
    } else {
      // Cambiar el color del borde a rojo si no es válido
      precioInput.style.border = '1px solid red';

      // Eliminar caracteres no válidos
      event.target.value = event.target.value.replace(/[^0-9.]/g, '');
    }
  });

  function limpiarInputs() {
    // Obtener referencias a los inputs
    var fechaInicialInput = document.getElementById('fechaInicial');
    var horaInput = document.getElementById('hora');
    var categoriaSelect = document.getElementById('categoria');
    var precioSelect = document.getElementById('precioProducto');
    var nombreProductoInput = document.getElementById('nombreProducto');
    var calificacionSelect = document.getElementById('calificacion');

    // Limpiar los valores de los inputs
    fechaInicialInput.value = '';
    horaInput.value = '';
    categoriaSelect.value = '';
    precioSelect.value = '';
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
    var precio = $('#precioProducto').val() ?? '0';
    var nombreProducto = $('#nombreProducto').val() ?? null;
    var calificacion = $('#calificacion').val() ?? '0';


    const formData = new FormData();
    formData.append('fecha', fecha);
    formData.append('hora', hora);
    formData.append('idcategoria', idcategoria);
    formData.append('precio', precio);
    formData.append('nombreProducto', nombreProducto);
    formData.append('calificacion', calificacion);
    formData.append('action', estado);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '../controllers/Reportes/POV_ClienteFiltro.php', true);
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
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                                    <div class="card" style="width: 100%;">
                                    <img src="data:image/jpeg;base64,${producto.Imagen}" class="card-img card-img-top" alt="${producto.Nombre}" style="width: 300px; height: 300px;">
                                        <div class="card-body">
                                        <h5 class="card-title mb-1">${producto.Nombre}</h5>
                                        <small class="card-text mb-1">${producto.Descripción}</small>
                                        <!-- Muestra las categorías -->
                                        <div class="categorias">
                                            ${producto.Categorias.map(categoria => `<small class="card-text mb-1"><strong> #${categoria}</strong></small>`).join('')}
                                        </div>
                                            <hr class="mt-2">
                                            <div class="calificacion pb-2">
                                            ${'<i class="bi bi-star-fill"></i>'.repeat(Math.floor(producto.PromedioCalificacion))}
                                            ${'<i class="bi bi-star"></i>'.repeat(5 - Math.floor(producto.PromedioCalificacion))}
                                            </div>
                                            <p class="card-text mb-1">Cantidad Comprada:
                                            ${producto.CantidadComprada}
                                            </p>
                                            <p class="card-text mb-1">Precio: $
                                            ${producto.Precio}
                                            </p>
                                            <p class="card-text mb-1">Total: $
                                            ${producto.Total}
                                            </p>
                                            <p class="card-text mb-1">Fecha de compra:
                                            ${producto.Fecha}
                                            </p>
                                            <p class="card-text mb-1">Hora de compra:
                                            ${producto.Hora}
                                            </p>
                                            <a href="Ticket.php?idProductoIndex= ${producto.idProducto}"
                                                class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                            <a href="Detalle_producto.php?idProductoIndex=${producto.idProducto}"
                                                class="btn btn-secondary mb-1" id="">Ver detalles del
                                                Producto</a>
                                        </div>
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
                <div class="card border mb-5" style="width: 50rem; ">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                    ${cotizacion.Archivos ? cotizacion.Archivos.map(archivo => `<img src="data:image/jpeg;base64,${archivo}" class="card-img card-img-top mx-auto" alt="${cotizacion.Nombre}" style="width: 20%;">`).join('')
                    : 'no hay datos'
                  }
                    </div>
                    <h5 class="card-title mb-1">
                    ${cotizacion.Nombre}
                    </h5>
                    <small class="card-text mb-1">
                    ${cotizacion.DescripcionCarrito}
                    </small><br>
                    <!-- Muestra las categorías -->
                    <div class="categorias">
                        ${cotizacion.Categorias.map(categoria => `<small class="card-text mb-1"><strong> #${categoria}</strong></small>`).join('')}
                    </div>
                    <hr class="mt-2">
                    <div class="card-body">
                    <table style="width:100%;">
                        <tr>
                            <td style="text-align: center;">
                                <p class="card-text mb-1"><strong>Materiales</strong></p>
                                ${cotizacion.Materiales ? cotizacion.Materiales.map(material => `
                                    <p class="card-text mb-1" style="color:  #F4BFAD;">
                                        <strong>${material.Nombre}</strong>
                                    </p>
                                                `).join('')
                    : 'No hay materiales'
                  }
                            </td>
                            <td style="text-align: center;">
                                <p class="card-text mb-1"><strong>Cantidad</strong></p>
                                ${cotizacion.Materiales ? cotizacion.Materiales.map(material => `
                                    <p class="card-text mb-1">${material.Cantidad}</p>
                                `).join('')
                    : 'No hay cantidad'
                  }
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="calificacion pb-2">
                ${'<i class="bi bi-star-fill"></i>'.repeat(Math.floor(cotizacion.PromedioCalificacion))}
                ${'<i class="bi bi-star"></i>'.repeat(5 - Math.floor(cotizacion.PromedioCalificacion))}
            </div>
                    <p class="card-text mb-1">Cantidad Comprada:
                    ${cotizacion.CantidadComprada}
                    </p>
                    <p class="card-text mb-1">Total: $
                    ${cotizacion.Total}
                    </p>
                    <p class="card-text mb-1">Fecha de compra: ${cotizacion.Fecha}</p>
                    <p class="card-text mb-1">Hora de compra: ${cotizacion.Hora}</p>
                    <a href="Detalle_producto.php?idProductoIndex=${cotizacion.idProducto}"
                        class="btn btn-secondary mb-1" id="">Ver detalles</a>
                    <a href="Ticket.php?idProductoIndex=${cotizacion.idProducto}"
                        class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                </div>
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


