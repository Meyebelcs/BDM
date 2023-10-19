<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Vendedor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/pages/POV_Perfil_Vendedor.css">


</head>

<body>

    <div class="container">
        <div class="btn-menu">
            <label for="btn-menu">☰</label>
        </div>
        <div class="logo"></div>

        <div class="d-flex align-items-center search-bar">
            <form action="Search.php" method="GET" class="input-group">

                <div class="navbar d-flex justify-content-between">
                    <a href="home.php" class="me-5 navbar-brand text-decoration-none">Amethyst</a>
                </div>
                <input class="form-control" type="search" name="searchBar" placeholder="Search" aria-label="Search">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </form>
            <!-- Fin de la barra de búsqueda -->

            <div class="custom-dropdown">
                <div class="dropdown">
                    <button class="btn text-light border-0 d-flex" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorias <i class="ms-2 bi bi-caret-down-fill"></i>
                    </button>
                    <ul class="dropdown-menu">

                        <li><a class="dropdown-item" href="">Electronica</a></li>
                        <li><a class="dropdown-item" href="">Perros</a></li>
                        <li><a class="dropdown-item" href="">Arte</a></li>

                    </ul>
                </div>
            </div>

            <div class="mt-2">
                <a class="btn text-light border-0 d-flex" type="button" href="chat.php">
                    <i class="bi bi-chat-dots-fill"></i>
                </a>
            </div>

        </div>
    </div>
    </div>



    </header>
    <div class="capa"></div>

    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <label for="btn-menu">✖️</label>
            <nav>

                <a href="student-profile.php">Cuenta</a>
                <a href="cart.php">Carrito</a>
                <a href="chat.php">Chat</a>
                <a href="course-visor.php">Mis Compras</a>
                <a href="#">Mis Listas</a>
                <a href="#">Mis Ventas</a>
            </nav>

        </div>
    </div>

    <main m-0 p-0 class="background">

        <!-- Hero -->
        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-xl-2 col-md-4 col-sm-5 col-xs-12">
                        <img src="./Styles/Assets/perfil.png" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-xl-10 col-md-8 col-sm-7 col-xs-12 m-auto">
                        <div class="container text-xs-center">
                            <div class="row">
                                <div class="col-12">
                                    <h4 id="nombre_Inst">Melany Arleth Jiménez Gómez</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>@arleth_mel</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6 id="birthday">27 de diciembre del 2002</h6>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#changePhoto">Cambiar foto</a>
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#editProfile">Editar perfil</a>
                                    <a class="btn btn-secondary mb-3" href="agregar-curso.php">Agregar Producto</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido -->


        <div class="container">
            <div class="mb-3 border-bottom d-flex align-items-center">
                <h3 class="p-2 pt-3" id="switchText">Productos Vendidos</h3>
                <!-- Interruptor de bolita -->
                <label class="switch">
                    <input type="checkbox" id="switchInput">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="row mt-3 pb-3">
                <div class="pb-3 d-flex col-xs-12 col-sm-6 col-md-6 col-lg-3 select-date">
                    <label for="fechaInicial" class="form-label me-3r">Fecha:</label>
                    <input id="fechaInicial" type="date" class="form-control w-50 buscar">
                </div>
                <div class="pb-3 d-flex col-xs-12 col-sm-6 col-md-6 col-lg-3 select-date">
                    <label for="hora" class="form-label me-3r">Hora:</label>
                    <input id="hora" type="time" class="form-control w-50 buscar">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 select-box">
                    <label for="categoria" class="form-label">Categoria:</label>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10 col-xs-10 select-box">
                    <select id="categoria" class="form-select buscar">
                        <option value="" selected></option>
                        <option value="3">Pintura</option>
                        <option value="2">Electronica</option>
                        <option value="1">Perros</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3 pb-3">
                <div class="pb-3 d-flex col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                    <label for="nombreProducto" class="form-label" style="white-space: nowrap;">Nombre del
                        Producto:</label>
                    <input id="nombreProducto" type="text" class="form-control">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 select-box">
                    <label for="calificacion" class="form-label">Calificación:</label>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10 col-xs-10 select-box">
                    <select id="calificacion" class="form-select buscar">
                        <option value="" selected></option>
                        <option value="5">5 estrellas</option>
                        <option value="4">4 estrellas</option>
                        <option value="3">3 estrellas</option>
                        <option value="2">2 estrellas</option>
                        <option value="1">1 estrella</option>
                    </select>
                </div>
            </div>


            <!-- Contenido -->
            <div class="container">

                <div class="productosStock">
                    <!-- Cards -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                   

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                 

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                 

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                    

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                    

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                   
                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                  

                                </div>
                            </div>
                        </div>
                        <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                            <div class="card" style="width: 100%;">
                                <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top"
                                    alt="Imagen actual">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Pintura de oleo</h5>
                                    <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                    <hr class="mt-2">
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Cantidad Vendida: 15</p>
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>
                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                    

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="productosCotizacion">
                    <!-- Cards COTIZACION--------->

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./Styles/Assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>

            <!-- Ingresos -->

            <div class="container mb-4">
                <div class="row pt-4 pb-3">
                    <div class="col-lg-12">
                        <h4 class="ms-5">Total de ingresos</h4>
                    </div>
                </div>
                <div class="row ms-5 pe-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Método de pago</th>
                                <th scope="col">Total de ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Tarjeta de crédito/débito</th>
                                <th scope="col" id="creditCard-ingresos"> $42,394 mxn</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">Paypal</th>
                                <th scope="col" id="paypal-ingresos"> $20,394 mxn</th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="container-fluid footer mt-auto bg-primary">
            <footer class="py-3 footer">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0">&copy; 2023 Amethyst. Todos los derechos reservados.</span>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script src="./js/POV_Perfil_Vendedor.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

</body>

</html>