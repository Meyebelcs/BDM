<!-- NOOO HA SIDO PROGRAMADA -->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
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
  <title>Admin Cotizaciones</title>

  <?php include_once "./libs/fonts.php" ?>
  <?php include_once "./libs/bootstrap.php" ?>
  <link rel="stylesheet" href="./css/pages/Admin_Cotizaciones.css">


</head>

<body>

  <!-- navbar.php -->
  <?php include('./components/navbar.php'); ?>

  <main m-0 p-0 class="background">

    <div class="col py-3">
      <div class="content">
        <div class="container mt-3">
          <div class="row">
            <h2>Información general</h2>
          </div>

          <div class="row d-flex flex-lg-row flex-sm-column flex-xs-column mt-3">
            <div class="card d-flex w-100 me-3 col mt-3">
              <div class="card-body col-12">
                <div class="row">
                  <div class="col-4 text-center">
                    <i class="bi bi-collection-play-fill"></i>
                  </div>
                  <div class="col-7 mt-2 ms-3">
                    <h5 class="card-title">Cotizaciones Aprobadas</h5>
                    <h5 class="card-text">
                      20,900
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="card d-flex w-100 me-3 col mt-sm-3 mt-xs-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-4  text-center">
                    <i class="bi bi-person-workspace"></i>
                  </div>
                  <div class="col-7 mt-2 ms-3">
                    <h5 class="card-title">Cotizaciones Denegadas</h5>
                    <h5 class="card-text">
                      3,000
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--   <div class="row mt-4">
                    <h2>Cotizaciones pendientes de revisión</h2>
                    </div> -->
        </div>
      </div>
    </div>

    <!-- Hero -->
    <div class="Hero">
      <div class="content">
        <div class="container mt-3">


          <div class="row">
            <div class="course-table col-12 me-3 mt-4">
              <h2>Cotizaciones pendientes de revisión</h2>
              <div class="row pt-3" id="no-more-tables">
                <table class="table table-borderless">
                  <thead class="border-bottom text-center">
                    <tr>
                      <th>Cotizaciones</th>
                      <th>Usuario</th>
                      <th>Detalle</th>
                      <th>Aceptar/Declinar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="text-center">
                      <td data-title="Cotización">Pinturas de Oleo</td>
                      <td data-title="Usuario">Elian Padilla</td>
                      <td data-title="Detalle">
                        <a class="btn btn-secondary" href="Detalle_producto.php">Ver detalles</a>
                      </td>
                      <td data-title="Aceptar/Declinar">
                        <a class="btn text-success" href=""><i class="bi bi-check-circle-fill"></i></a>
                        <a class="btn text-danger" href=""><i class="bi bi-x-circle-fill"></i></a>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotización">Manualidades</td>
                      <td data-title="Usuario">Mary Sofia</td>
                      <td data-title="Detalle">
                         <a class="btn btn-secondary" href="Detalle_producto.php">Ver detalles</a>
                      </td>
                      <td data-title="Aceptar/Declinar">
                        <a class="btn text-success" href=""><i class="bi bi-check-circle-fill"></i></a>
                        <a class="btn text-danger" href=""><i class="bi bi-x-circle-fill"></i></a>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotización">Mesas de maders</td>
                      <td data-title="Usuario">Daniel Gomez</td>
                      <td data-title="Detalle">
                         <a class="btn btn-secondary" href="Detalle_producto.php">Ver detalles</a>
                      </td>
                      <td data-title="Aceptar/Declinar">
                        <a class="btn text-success" href=""><i class="bi bi-check-circle-fill"></i></a>
                        <a class="btn text-danger" href=""><i class="bi bi-x-circle-fill"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="disabled-course-table col-12 me-3 mt-4 mb-4">
              <h2>Cotizaciones Denegadas</h2>
              <div class="row pt-3" id="no-more-tables">
                <table class="table table-borderless">
                  <thead class="border-bottom text-center">
                    <tr>
                      <th>Cotizaciones</th>
                      <th>Usuario</th>
                      <th>Detalle</th>
                      <th>Activar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">feroo</td>
                      <td data-title="Usuario">Abiel Mario</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">fs</td>
                      <td data-title="Usuario">Oliver Joe</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">gg</td>
                      <td data-title="Usuario">Melissa Castro</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">gatos</td>
                      <td data-title="Usuario">Jorge Esteban</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">juguetes</td>
                      <td data-title="Usuario">Regina Mirna</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>
                    <tr class="text-center">
                      <td data-title="Cotizaciones">rollo</td>
                      <td data-title="Usuario">Amanda Mirabel</td>
                      <td data-title="Detalle"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="Detalle_producto.php">Ver detalles</a></button></td>
                      <td data-title="Activar"><button class="btn btn-secondary ">
                          <a class="nav-link text-white" href="">Activar</a></button></td>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include('./components/footer.php'); ?>


    <?php include_once "./libs/jqueryJS.php" ?>
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/sweetalertJS.php" ?>
    <script src="./js/Admin_Cotizaciones.js"></script>

  </main>
</body>

</html>