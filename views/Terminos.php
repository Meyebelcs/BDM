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
  <title>Stock & Custom</title>

  <?php include_once "./libs/bootstrap.php" ?>
  <?php include_once "./libs/fonts.php" ?>
  <?php include_once "./libs/swiper.php" ?>
  <link rel="stylesheet" href="./css/pages/Terminos.css">

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
          <p class="LOGOF1">Stock & Custom</p>
        </div>
    </div>
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
        <a href=<?php echo $url ?>><?php echo $titulo ?></a>
        <a href="Terminos.php">Términos y Condiciones</a>
        <a href="../controllers/logout.php">Salir</a>
      </nav>

    </div>
  </div>

  <main m-0 p-0>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item item1 active p-4">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center">
              <img class="d-lg-block d-none h-100" src="./css/assets/best-coursess.png" alt="best-courses">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center">
                <h1>Registrate y encuentra los mejores precios en </h1>
                <h3>Stock & Custom</h3>
                <p>Ofertas</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item item1">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center p-5">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center text-shadow">
                <h1>Ofetas todos los dias</h1>
                <p>Unete hoy</p>
              </div>
              <img class="d-lg-block d-none h-100" src="./css/assets/work-with-only-the-bests.png" alt="best-courses">
            </div>
          </div>
        </div>
        <div class="carousel-item item1">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center">
              <img class="d-lg-block d-none h-100" src="./css/assets/user-scenarios.png" alt="best-courses">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center">
                <h1>Registrate en Stock & Custom</h1>
                <p>Empieza a ahorra ya</p>
              </div>
            </div>
          </div>
        </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>



    <!-- Términos y condiciones -->
    <div class="terms-and-conditions">
      <h2>Términos y Condiciones</h2>

      <p>Bienvenido a Stock & Custom. Al acceder y utilizar nuestro sitio web, aceptas cumplir con los siguientes
        términos y condiciones:</p>

      <h3>1. Uso del Sitio</h3>
      <p>El uso de este sitio web está sujeto a las siguientes condiciones:</p>
      <ul>
        <li>1.1. El contenido del sitio es solo para información general y sujeto a cambios sin previo aviso.</li>
        <li>1.2. No garantizamos la exactitud, actualidad, rendimiento o idoneidad de la información y los materiales
          encontrados u ofrecidos en este sitio para un propósito particular.</li>
      </ul>

      <h3>2. Registro de Usuario</h3>
      <p>2.1. Para acceder a ciertas funciones del sitio, es posible que debas registrarte como usuario.</p>
      <p>2.2. Eres responsable de mantener la confidencialidad de tu información de inicio de sesión y de todas las
        actividades que ocurran bajo tu cuenta.</p>

      <h3>3. Privacidad y Seguridad</h3>
      <p>3.1. Nos comprometemos a proteger tu privacidad y la seguridad de la información proporcionada durante el uso
        del sitio. Consulta nuestra Política de Privacidad para obtener más detalles.</p>

      <h3>4. Compras y Pagos</h3>
      <p>4.1. Al realizar una compra a través de nuestro sitio, aceptas cumplir con los términos de pago especificados.
        Todos los detalles de pago son manejados de manera segura.</p>
      <p>4.2. Nos reservamos el derecho de cambiar precios y disponibilidad de productos sin previo aviso.</p>

      <h3>5. Contenido del Usuario</h3>
      <p>5.1. Si decides contribuir con contenido al sitio, garantizas que tienes los derechos necesarios y aceptas que
        dicho contenido puede ser utilizado por Stock & Custom con fines comerciales.</p>

      <h3>6. Responsabilidades y Limitaciones</h3>
      <p>6.1. Stock & Custom no será responsable por daños directos, indirectos, incidentales o consecuentes resultantes
        del uso o la incapacidad de utilizar el sitio.</p>
      <p>6.2. Nos reservamos el derecho de suspender o cerrar cuentas de usuarios que violen estos términos y
        condiciones.</p>

      <h3>7. Cambios en los Términos</h3>
      <p>7.1. Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Los cambios
        entrarán en vigencia inmediatamente después de su publicación en el sitio.</p>

      <h3>8. Ley Aplicable</h3>
      <p>8.1. Estos términos y condiciones se rigen por las leyes del [tu país o región]. Cualquier disputa que surja
        estará sujeta a la jurisdicción exclusiva de los tribunales de [tu ciudad o región].</p>
      <h3>9. Propiedad Intelectual</h3>
      <p>9.1. Todos los derechos de propiedad intelectual relacionados con el sitio y su contenido son propiedad
        exclusiva de Stock & Custom.</p>
      <p>9.2. Queda estrictamente prohibida la reproducción, distribución o modificación de cualquier parte del sitio
        sin nuestro consentimiento expreso.</p>

      <h3>10. Suspensión y Terminación</h3>
      <p>10.1. Nos reservamos el derecho de suspender o terminar tu acceso al sitio en cualquier momento y por cualquier
        motivo, incluido el incumplimiento de estos términos y condiciones.</p>
      <p>10.2. En caso de suspensión o terminación, debes dejar de utilizar el sitio de inmediato, y cualquier uso
        posterior será considerado como no autorizado.</p>

      <h3>11. Enlaces a Terceros</h3>
      <p>11.1. El sitio puede contener enlaces a sitios web de terceros. No tenemos control sobre el contenido, la
        privacidad o las prácticas de seguridad de estos sitios y no asumimos responsabilidad alguna por ellos.</p>
      <p>11.2. Recomendamos revisar los términos y condiciones de cualquier sitio al que accedas a través de enlaces
        desde nuestro sitio.</p>

      <h3>12. Comunicaciones</h3>
      <p>12.1. Al utilizar el sitio, aceptas recibir comunicaciones de nuestra parte, incluidos correos electrónicos
        relacionados con tu cuenta, actualizaciones del sitio y ofertas especiales.</p>
      <p>12.2. Puedes optar por no recibir comunicaciones promocionales en cualquier momento ajustando la configuración
        de notificaciones en tu cuenta.</p>
      <p>Estos términos y condiciones constituyen el acuerdo completo entre el usuario y Stock & Custom. Si tienes
        alguna pregunta o inquietud, contáctanos a [correo electrónico de contacto].</p>


    </div>


    <p style="text-align: center; color: #ffffff; margin: 20px 0;">Última Actualización: [13/11/2023]</p>
    <!-- -----------scripts-------------->

    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/swiperJS.php" ?>
    <script src="./js/landingPage.js"></script>



  </main>

</body>

</html>