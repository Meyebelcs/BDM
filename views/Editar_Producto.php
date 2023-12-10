<?php
session_start();

require_once './components/menu.php';
//Sereedirige a home si no ha seleccionado ningun producto para mostrar
if (!isset($_GET['idProductoSelected'])) {
  header('Location: home.php');
  exit;
}

require_once "../models/Producto.php";
require_once "../models/Archivo.php";
require_once "../models/Material_Inventario.php";

$idProductoSelected = $_GET['idProductoSelected'];
$producto = Product::findProductoById($mysqli, $idProductoSelected);
$archivos = Archivo::getArchivoByProduct($mysqli, $idProductoSelected);



?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">


  <link rel="stylesheet" href="./css/pages/Alta_Producto.css">


</head>

<body>
  <!-- navbar.php -->
  <?php include('./components/navbar.php'); ?>

  <main m-0 p-0 class="background">

    <!-- Hero -->
    <div class="text-center mb-3">
      <h3 class="border-bottom p-2 pt-3" id="switchText">Editar Producto</h3>
      
      <input type="hidden" id="idProductoHidden" name=" <?php echo $idProductoSelected ?>"
          value=" <?php echo $idProductoSelected ?>" />
    </div>

    <div class="container">
      <!---------------- productosStock---------->

      <?php

      if ($producto->getTipo() === 'Stock') { ?>

        <div class="productosStock">
          <form class="row" method="post" action="../controllers/Producto/Editar_Producto.php" id="create-Product"
            enctype="multipart/form-data">
            <div class="row">
              <input type="hidden" name="idUser" id="idUser" value="<?php echo $idUser; ?>">

              <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="mb-3">
                  <label for="Nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="name" value="<?php echo $producto->getNombre(); ?>">
                  <span class="text-danger" id="name_error_message"></span><br>
                </div>
                <div class="mb-3">
                  <label for="descripcion" class="form-label">Descripción</label>
                  <textarea class="form-control" id="desc" rows="3"><?php echo $producto->getDescripcion(); ?></textarea>
                  <span class="text-danger" id="description_error_message"></span><br>
                </div>

                <!--  <div class="row mb-3">
                  <div class="d-flex">
                    <select class="w-100" multiple="true" id="select-categories">
                      <?php
                      /*  $html = "";
                       foreach ($categorias as $categoria) {
                         $html .= "<option  id = '" . $categoria['idCategoria'] . "' value='" . $categoria['Nombre'] . "'>" . $categoria["Nombre"] . "</option>";
                       }
                       echo $html; */
                      ?>
                    </select>
                    <button type="button" class="AddCategoryClic ms-3 btn btn-secondary btn-sm m-auto w-25"
                      data-bs-toggle="modal" data-bs-target="#addCategory">Añadir categoria</button>
                  </div>
                  <span class="text-danger" id="categories_error_message"></span><br>
                </div> -->
                <div class="row">
                  <div class="col-12 m-3">
                    <div class="row ">
                      <div class="d-flex justify-content-between">
                        <label class="form-label pt-2 me-3" for="">Costo:</label>
                        <input class="form-control" type="text" id="price" value="<?php echo $producto->getPrecio(); ?>">
                      </div>
                      <span class="text-danger" id="price_error_message"></span><br>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 m-3">
                    <div class="row ">
                      <div class="d-flex justify-content-between">
                        <label class="form-label pt-2 me-3" for="">Inventario:</label>
                        <input class="form-control" type="text" id="inventario"
                          value="<?php echo $producto->getInventario(); ?>">
                      </div>
                      <span class="text-danger" id="inventario_error_message"></span><br>
                    </div>
                  </div>
                </div>
              </div>
              <!--  <div class="center mt-2 col-lg-6 col-sm-12 col-xs-12 image-container">
                <div class="wrapper">
                  <div class="box ">
                    <div class="input-bx d-flex flex-column align-items-center">
                      <label for="Upload" class="uploadlabel" id="img-holder">
                        <span class=""><i class="bi bi-cloud-arrow-up-fill"></i></span>
                        <p>Añade una imagen</p>
                      </label>
                      <img src="" class="preview-img" alt="">
                      <input type="file" id="Upload" name="Upload" class="form-control mt-3">
                      <span class="text-danger" id="photo_error_message"></span>
                    </div>
                  </div>
                </div>
                <div class="image-previews  m-2 d-flex flex-wrap align-items-center" id="image-previews-container"></div>
                <span class="text-danger" id="img_error_message"></span><br>
              </div> -->
            </div>

            <button type="submit" class="btn btn-secondary m-4">Editar Producto</button>
            <!-- <span class="text-danger" id="modal_error_message"></span><br> -->
          </form>

        </div>

      <?php } ?>





      <!-- Cards COTIZACION--------->

      <?php

      if ($producto->getTipo() === 'Cotizacion') { ?>
      <div class="productosCotizacion">
        <form class="row" method="POST" action="../controllers/Producto/Editar_Cotizacion.php" id="formCotizacion"
          enctype="multipart/form-data">
          <div class="row">
            <input type="hidden" name="idUserCotizacion" id="idUserCotizacion" value="<?php echo $idUser; ?>">
            <div class="col-lg-6 col-sm-12 col-xs-12">
              <div class="mb-3">
                <label for="NombreCotizacion" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nameCotizacion"
                  value="<?php echo $producto->getNombre(); ?>">
                <span class="text-danger" id="name_error_messageCotizacion"></span><br>
              </div>
              <div class="mb-3">
                <label for="descripcionCotizacion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descCotizacion"
                  rows="3"><?php echo $producto->getDescripcion(); ?></textarea>
                <span class="text-danger" id="description_error_messageCotizacion"></span><br>
              </div>

            </div>


            <!-- Botón para mostrar/ocultar el div -->
              <button type="button" id="mostrarMaterialesBtn" class="btn btn-secondary mt-3" style="width: 100px;  height: 100px;">Editar Materiales</button>


              <div class="editmateriales" style="display: none;">

                <!-- MATERIALES -->
                <div class="row mt-4">
                  <div class="col-lg-12 p-2 d-flex">
                    <h4 class="pe-4">Materiales</h4>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                      data-bs-target="#addmaterial">Añadir Material</button>
                  </div>
                </div>

                <div class="row">
                  <div class="accordion levels" id="levels">

                    <?php
                    $mysqli = db::connect();
                    $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $idProductoSelected);
                    foreach ($materialesbyproduct as $material) {
                      echo $material->getNombre();
                      echo $material->getIdMaterial();

                    } ?>

                  </div>
                </div>
                <span class="text-danger" id="material_error_messageCotizacion"></span><br>
              </div>



              <button type="submit" class="btn btn-secondary m-4 mb-9">Editar Cotización</button>

          </form>
        </div>
      <?php } ?>

    </div>


    <!-- Modal Añadir material-->
    <div class="modal fade" id="addmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="add-material" class="modal-content">
          <input type="hidden" name="formulario" value="addmaterial-form">
          <div class="modal-header">
            <h4>Añadir material</h4>
          </div>
          <div class="modal-body">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="material-name" name="name-add-material">
            <span class="text-danger" id="material_name_error_message"></span><br>

            <label class="form-label pt-2 me-3" for="">Cantidad:</label>
            <input class="form-control" type="text" id="material-cantidad" name="costo-add-material">
            <span class="text-danger" id="material_cantidad_error_message"></span><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Cerrar</button>
            <button type="button" id="add-material-btn" class="btn btn-secondary">Añadir material</button>
            <span class="text-danger" id="material_error_message"></span><br>
          </div>
        </form>
      </div>
    </div>


    <!-- Modal editar material-->
    <div class="modal fade" id="editmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="edit-material" class="modal-content">
          <div class="modal-header">
            <h4>Editar material</h4>
          </div>
          <div class="modal-body">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="material-edit-name" name="namematerialeditname">
            <span class="text-danger" id="material_edit_name_error_message"></span><br>
            <label class="form-label pt-2 me-3" for="">Cantidad:</label>
            <input class="form-control" type="text" id="material-edit-price" name="namematerialeditcosto">
            <span class="text-danger" id="material_edit_price_error_message"></span><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
              id="close-edit-material">Cerrar</button>
            <button type="button" id="edit-material-btn" class="btn btn-secondary">Guardar cambios</button>
            <span class="text-danger" id="material_edit_error_message"></span><br>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal delete material-->
    <div class="modal fade" id="deletematerial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="add-material" class="modal-content">
          <input type="hidden" name="formulario" value="addmaterial-form">
          <div class="modal-header">
            <h4>Eliminar material</h4>
          </div>
          <div class="modal-body">
            <h6>¿Estás seguro de que deseas eliminar este material?</h6>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Cerrar</button>
            <button type="button" id="delete-material-btn" class="btn btn-secondary">Eliminar</button>
            <span class="text-danger" id="material_error_message"></span><br>
          </div>
        </form>
      </div>
    </div>


  </main>

  <!-- Modal Añadir categoria-->
  <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog">
      <form class="modal-content" id="create-category">
        <input type="hidden" name="formulario" value="category-form">
        <div class="modal-header">
          <h4>Añadir categoría</h4>
        </div>
        <div class="modal-body">
          <label for="Nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="name-Category" id="category-name">
          <span class="text-danger" id="category_name_error_message"></span><br>
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="category-desc" name="desc-Category" rows="3"></textarea>
          <span class="text-danger" id="category_description_error_message"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Cerrar</button>
          <button type="button" class="btn btn-secondary" id="btn_savechangesCat">Guardar</button>
          <span class="text-danger" id="category_error_message"></span>
        </div>
      </form>
    </div>
  </div>
  <!-- Footer -->
  <?php include('./components/footer.php'); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <script src="./js/Category.js"></script>
  <script type="module" src="./js/Material.js"></script>
  <script type="module" src="./js/Editar_Producto.js"></script>

</body>

</html>