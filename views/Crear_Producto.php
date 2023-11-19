<?php
session_start();

require_once './components/menu.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>

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

        <div class="container">
            <div class="productosStock">

                <form class="row" id="create-Product" action="../controllers/simple.php" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="idUser" id="idUser" value="<?php echo $idUser; ?>">

                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name">
                                <span class="text-danger" id="name_error_message"></span><br>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="desc" rows="3"></textarea>
                                <span class="text-danger" id="description_error_message"></span><br>
                            </div>

                            <div class="row mb-3">
                                <div class="d-flex">
                                    <select class="w-100" multiple="true" id="select-categories">
                                        <?php
                                        $html = "";
                                        foreach ($categorias as $categoria) {
                                            $html .= "<option  id = '" . $categoria['idCategoria'] . "' value='" . $categoria['Nombre'] . "'>" . $categoria["Nombre"] . "</option>";
                                        }
                                        echo $html;
                                        ?>
                                    </select>
                                    <button type="button"
                                        class="AddCategoryClic ms-3 btn btn-secondary btn-sm m-auto w-25"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryStock">Añadir
                                        categoria</button>
                                </div>
                                <span class="text-danger" id="categories_error_message"></span><br>
                            </div>
                            <div class="row">
                                <div class="col-12 m-3">
                                    <div class="row ">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label pt-2 me-3" for="">Costo:</label>
                                            <input class="form-control" type="text" id="price">
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
                                            <input class="form-control" type="text" id="inventario">
                                        </div>
                                        <span class="text-danger" id="inventario_error_message"></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="file">Selecciona un archivo:</label>
                        <input type="file" id="file" name="file">
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
                            <div class="image-previews  m-2 d-flex flex-wrap align-items-center"
                                id="image-previews-container"></div>
                            <span class="text-danger" id="img_error_message"></span><br>
                        </div> -->
                    </div>

                    <button type="submit" class="btn btn-secondary m-4">Crear Producto</button>
                    <!-- <span class="text-danger" id="modal_error_message"></span><br> -->
                </form>

                <!-- Modal Añadir categoria STOCK-->
                <div class="modal fade" id="addCategoryStock" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
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
                                <textarea class="form-control" id="category-desc" name="desc-Category"
                                    rows="3"></textarea>
                                <span class="text-danger" id="category_description_error_message"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    id="closeStock">Cerrar</button>
                                <button type="button" class="btn btn-secondary"
                                    id="btn_savechangesCatStock">Guardar</button>
                                <span class="text-danger" id="category_error_message"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="productosCotizacion">

            </div>

        </div>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="close">Cerrar</button>
                        <button type="button" class="btn btn-secondary" id="btn_savechangesCat">Guardar</button>
                        <span class="text-danger" id="category_error_message"></span>
                    </div>
                </form>
            </div>
        </div>




        <!-- Modal Añadir material-->
        <div class="modal fade" id="addLevel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="add-level" class="modal-content">
                    <input type="hidden" name="formulario" value="addlevel-form">
                    <div class="modal-header">
                        <h4>Añadir material</h4>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="level-name" name="name-add-Level">
                        <span class="text-danger" id="level_name_error_message"></span><br>

                        <label class="form-label pt-2 me-3" for="">Cantidad:</label>
                        <input class="form-control" type="text" id="level-price" name="costo-add-Level">
                        <span class="text-danger" id="level_price_error_message"></span><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="close">Cerrar</button>
                        <button type="button" id="add-level-btn" class="btn btn-secondary">Añadir material</button>
                        <span class="text-danger" id="level_error_message"></span><br>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal editar material-->
        <div class="modal fade" id="editLevel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="edit-level" class="modal-content">
                    <div class="modal-header">
                        <h4>Editar material</h4>
                    </div>
                    <div class="modal-body">
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="level-edit-name" name="nameleveleditname">
                        <span class="text-danger" id="level_edit_name_error_message"></span><br>
                        <label class="form-label pt-2 me-3" for="">Cantidad:</label>
                        <input class="form-control" type="text" id="level-edit-price" name="nameleveleditcosto">
                        <span class="text-danger" id="level_edit_price_error_message"></span><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="close-edit-level">Cerrar</button>
                        <button type="button" id="edit-level-btn" class="btn btn-secondary">Guardar cambios</button>
                        <span class="text-danger" id="level_edit_error_message"></span><br>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal delete material-->
        <div class="modal fade" id="deleteLevel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="add-level" class="modal-content">
                    <input type="hidden" name="formulario" value="addlevel-form">
                    <div class="modal-header">
                        <h4>Eliminar material</h4>
                    </div>
                    <div class="modal-body">
                        <h6>¿Estás seguro de que deseas eliminar este material?</h6>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="close">Cerrar</button>
                        <button type="button" id="delete-level-btn" class="btn btn-secondary">Eliminar</button>
                        <span class="text-danger" id="level_error_message"></span><br>
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
        <script src="./js/Alta_Producto.js"></script>
    </main>
</body>

</html>