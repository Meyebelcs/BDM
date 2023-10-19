<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Login</title>

  <link rel="stylesheet" href="./css/pages/login.css">
  <?php include_once "./libs/bootstrap.php" ?>

</head>

<body>

  <header class="d-none d-md-block">
    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="./css/assets/show.mp4" type="video/mp4">
    </video>
    <div class="container h-100">
      <div class="d-flex text-center h-100">
        <div class="my-auto w-100 text-white">
          <h2>Bienvenido a </h2>
          <h1 class="logo">Stock & Custom</h1>
        </div>
      </div>
    </div>
  </header>

  <div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="myform form ">
      <div class="mb-3">
        <div class="col-md-12 text-center">
          <h1>Login</h1>
        </div>
      </div>
      <form id="login" method="post">
        <div class="form-group">
          <label>Nombre de usuario </label>
          <input type="text" id="username" name="usernameLogin" class="form-control mt-3 mb-3"
            placeholder="Ingresa username">
          <span class="text-danger" id="username_error_message"></span><br>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Contraseña</label>
          <input type="password" name="passwordLogin" id="password" placeholder="Ingresa Contraseña"
            class="form-control mt-3 mb-3">
          <span class="text-danger" id="password_error_message"></span><br>
        </div>
        <span class="text-danger" id="modal_error_message"></span><br>


        <div class="col-md-12 text-center ">
          <button type="button" class=" btn w-100 btn-secondary border-0 " id="btn_login"> Login</button>
        </div>

        <div class="form-group">
          <p class="text-center">¿No tienes una cuenta? <a href="register.php" id="signup">Registrate aquí</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal ingreso-->
  <div class="customize-theme" id="miModal" style="display: none;">
    <div class="card">
      <h2 style="font-size:medium;">Se ingresó correctamente</h2>
      <button type="submit" class=" btn w-100 btn-secondary border-0 " id="OK">Ok</button>
    </div>
  </div>

  <?php include_once "./libs/jqueryJS.php" ?>
  <script src="./js/login.js"></script>

</body>

</html>