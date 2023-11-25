
<?php
session_start();

require_once './components/menu.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/chat2.css">

</head>

<body>

    <nav class="sticky-top shadow-sm navbar-expand-lg">
        <div class="container-fluid border-0 bg-primary">

            <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>

            <div class="capa"></div>

            <input type="checkbox" id="btn-menu">
            <div class="container-menu">
                <div class="cont-menu">
                    <label for="btn-menu">✖️</label>
                    <nav>

                        <a href=<?php echo $urlPerfil ?>>Cuenta</a>
                        <a href="Carrito.php">Carrito</a>
                        <a href="chat.php">Chat</a>
                        <a href=<?php echo $url ?>>
                            <?php echo $titulo ?>
                        </a>
                        <a href="../controllers/logout.php">Salir</a>
                    </nav>

                </div>
            </div>
            <div class="navbar d-flex justify-content-between">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form action="Busqueda.php" method="GET" class="input-group">

                        <div class="navbar d-flex justify-content-between">
                            <a href="home.php" class="me-5 navbar-brand text-decoration-none">Stock & Custom</a>
                        </div>

                        <input class="form-control" type="search" name="searchBar" placeholder="Search"
                            aria-label="Search">
                        <button type="submit" class="btn btn-secondary">Buscar</button>
                    </form>
                    <!-- Fin de la barra de búsqueda -->

                    <div class="custom-dropdown">
                        <div class="dropdown">
                            <button class="btn text-light border-0 d-flex" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Categorias <i class="ms-2 bi bi-caret-down-fill"></i>
                            </button>

                            <!-- -----------categorias-------- -->
                            <ul class="dropdown-menu">
                                <?php foreach ($categorias as $categoria) { ?>
                                    <li><a class="dropdown-item"
                                            href="Busqueda.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                            <?php echo $categoria['Nombre'] ?>
                                        </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <?php
                    if ($rol !== "Administrador") {
                        echo '<div class="mt-2">
                                    <a class="btn text-light border-0 d-flex" type="button" href="chat.php">
                                        <i class="bi bi-chat-dots-fill"></i>
                                    </a>
                                    </div>';
                    } ?>

                    <div class="dropdown mt-2">
                        <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                            $username = $user->getUsername();
                            ?>
                            <img src="<?= $userImage ?>" alt="<?= $username ?>" width="35" height="35"
                                class="rounded-circle">
                            <?= $username ?>
                        </button>
                    </div>
                </div>

            </div>
        </div>


    </nav>

            <!-- Contenido -->
 <div id="container">
        <aside>
            <header>
            <input type="text" placeholder="search">
            </header>
            <ul>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
               
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
               
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">
                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            <li>
            <img class="round-image" src="../views/css/assets/vangogh.png" alt="">

                <div>
                <h2>Prénom Nom</h2>
                
                </div>
            </li>
            </ul>
        </aside>
        <main>
            
            
            </header>
            <ul id="chat">
            <li class="you">
                <div class="entete">
                
            
            </li>
            <li class="you">
                <div class="entete">
                
                <h2>Vincent</h2>
                <h3>10:12AM, Today</h3>
                </div>
                
                <div class="message">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                </div>
            </li>
            <li class="me">
                <div class="entete">
                <h3>10:12AM, Today</h3>
                <h2>Vincent</h2>
                
                </div>
                
                <div class="message">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                </div>
            </li>
            <li class="me">
                <div class="entete">
                <h3>10:12AM, Today</h3>
                <h2>Vincent</h2>
                
                </div>
                
                <div class="message">
                OK
                </div>
            </li>
            <li class="me">
                <div class="entete">
                <h3>10:12AM, Today</h3>
                <h2>Vincent</h2>
                
                </div>
                
                <div class="message">
                OK
                </div>
            </li>
            <li class="me">
                <div class="entete">
                <h3>10:12AM, Today</h3>
                <h2>Vincent</h2>
                
                </div>
                
                <div class="message">
                OK
                </div>
            </li>
            <li class="me">
                <div class="entete">
                <h3>10:12AM, Today</h3>
                <h2>Vincent</h2>
                
                </div>
                
                <div class="message">
                OK
                </div>
            </li>
            </ul>

            


            
            <footer>
            <textarea placeholder="Type your message"></textarea>
            
            <a href="#">Send</a>
            </footer>


         

            </main>

       

   
    <!-- Otros elementos que desees agregar -->
</div>
</div>
<div class="cotizacion">
          <div class="cotizacion-titulo">
    <h1>Producto:</h1>
    <h2>Cama</h2>
    <h2>Descripcion:<h2>
    <h3 class="descripcion-con-contorno">Gran producto con madera de sauce y pino, con últimos acabados en madera y clavos de pino</h3>  </div>
  <div class="row mt-4">
              <div class="col-lg-12 p-2 d-flex">
                <h4 class="pe-4">Materiales</h4>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                  data-bs-target="#addmaterial">Añadir Material</button>
              </div>
            </div>

            <div class="row">
              <div class="accordion levels" id="levels">

              </div>
              <span class="text-danger" id="material_error_messageCotizacion"></span><br>
              <button type="submit" class="btn btn-secondary m-4 mb-9">Crear Cotización</button>
              
        </form>
      </div>
    </div>
                        
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
            <div class="container mt-1">
    <select class="form-control" id="Lista" name="Lista">
        <option selected disabled>Mascotas</option>
        <option value="gato">Gato 1</option>
        <option value="perro">Perro 2</option>
        <option value="conejo">Conejo 3</option>
        <option value="hamster">Hamster 4</option>
        <option value="loro">Loro 5</option>
        <option value="tortuga">Tortuga 6</option>
    </select>
</div>
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


</select>
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
                        
</div>
                            
</body>


                                <?php include_once "./libs/jqueryJS.php" ?>
                                <?php include_once "./libs/bootstrapJS.php" ?>
                                <!--  <script src="./js/chat.js"></script> -->
</html>