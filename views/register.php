<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Registro</title>

  <link rel="stylesheet" href="./css/pages/register.css">
  <?php include_once "./libs/bootstrap.php" ?>

</head>

<body>
  <div class="container d-flex justify-content-center">

    <div class="myform form ">
      <div class="mb-3">
        <div class="col-md-12 text-center">
          <h1>Registrar</h1>
        </div>
      </div>

      <form id="register" method="post">
        <div class="form-group mb-3 d-flex justify-content-between">

          <div class="w-100 me-3">
            <label>Nombres</label>
            <input type="text" class="form-control" name="nameRegistro" id="name" placeholder="Ingresa tu nombre">
            <span class="text-danger" id="fname_error_message"></span><br>
          </div>

          <div class="w-100">
            <label>Apellidos</label>
            <input type="text" class="form-control" name="last-nameRegistro" id="last-name"
              placeholder="Ingresa tu nombre apellido">
            <span class="text-danger" id="sname_error_message"></span><br>
          </div>

        </div>

        <div class="form-group mb-3">
          <label>Nombre de Usuario </label>
          <input type="text" name="usernameRegistro" class="form-control" id="username">
          <span class="text-danger" id="username_error_message"></span><br>
        </div>

        <div class="form-group mb-3">
          <label>Email </label>
          <input type="email" name="emailRegistro" class="form-control" id="email" placeholder="name@ejemplo.com">
          <span class="text-danger" id="email_error_message"></span><br>
        </div>

        <div class="d-flex justify-content-between mb-3">

          <div class="form-group w-100 me-2">
            <label class="form-label">Rol</label>
            <select id="rol" name="rolRegistro" class="form-select" onchange="mostrarModalidad()">
              <option value="" selected>...</option>
              <option>Vendedor</option>
              <option>Comprador</option>
            </select>
            <span class="text-danger" id="rol_error_message"></span><br>
          </div>

          <div class="form-group w-100 ms-2 me-2">
            <label class="form-label">Género</label>
            <select id="gender" name="genderRegistro" class="form-select">
              <option value="" selected>...</option>
              <option>Mujer</option>
              <option>Hombre</option>
              <option>Otro</option>
            </select>
            <span class="text-danger" id="gender_error_message"></span><br>
          </div>

          <div class=" form-group w-100 ms-2">
            <label class="form-label">Fecha de Nacimiento</label>
            <input id="birthday" name="birthdayRegistro" class="form-control" type="date">
            <span class="text-danger" id="birthday_error_message"></span><br>
          </div>

          <div id="modalidadDiv" class="form-group w-100 ms-2 me-2" style="display: none;">
            <label class="form-label">Modalidad</label>
            <select id="mod" name="modRegistro" class="form-select">
              <option value="" selected>...</option>
              <option>Público</option>
              <option>Privado</option>
            </select>
            <span class="text-danger" id="modalidad_error_message"></span><br>
          </div>

        </div>

        <div class="form-group mb-3">
          <label>Contraseña</label>
          <input type="password" name="passwordRegistro" id="password" class="form-control"
            placeholder="Ingresa contraseña">
          <span class="text-danger" id="password_error_message"></span><br>
        </div>

        <div class="form-group mb-3">
          <label>Confirmar contraseña</label>
          <input type="password" name="retype-password" id="retype-password" class="form-control"
            placeholder="Confirma contraseña">
          <span class="text-danger" id="confirm_password_error_message"></span><br>
        </div>

        <div class="mb-3">
          <label class="form-label">Imagen de perfil</label>
          <input class="form-control" name="profile-pictureRegistro" type="file" id="profile-picture">
          <span class="text-danger" id="photo_error_message"></span><br>
        </div>

        <!--------------BOTÓN DE REGISTRO------------------->
        <div class="col-md-12 text-center ">
          <button type="button" id="btn-register" class="w-100 btn btn-secondary border-0 tx-tfm">Registrar</button>
        </div>

        <div class="form-group">
          <p class="text-center">¿Ya tienes una cuenta? <a href="login.php" id="signup">Inicia sesión aquí</a></p>
        </div>

      </form>

    </div>
  </div>

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

  <!-- Modal-->
  <div class="customize-theme" id="miModal" style="display: none;">
    <div class="card">
      <h2 style="font-size:medium;">Se guardó correctamente</h2>
      <button type="submit" class=" btn w-100 btn-secondary border-0 " id="OK">Ok</button>
    </div>
  </div>
  
  <?php include_once "./libs/jqueryJS.php" ?>
  <script src="./js/register.js"></script>

</body>

</html>