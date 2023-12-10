<!-- NOOO HA SIDO PROGRAMADA -->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<?php
session_start();

$perfil="PerfilAdmin";

require_once './components/POV_menu.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Administrador</title>


    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/POV_Perfil.css">
    <link rel="stylesheet" href="./css/pages/unpload.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">

        <!-- <div class="col py-3">
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
                                        <h5 class="card-title">Productos</h5>
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
                                    <div class="col-4 text-center">
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Cotizaciones</h5>
                                        <h5 class="card-text">
                                            10,000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex w-100 me-3 col mt-sm-3 mt-xs-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Vendedores</h5>
                                        <h5 class="card-text">
                                            10,000
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
                                        <h5 class="card-title">Clientes</h5>
                                        <h5 class="card-text">
                                            3,000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h3>Perfil</h3>
                    </div>
                </div> 
            </div>
        </div>-->

        <!-- Hero -->
        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-12 text-center mb-3">
                        <?php
                        $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                        $username = $user->getUsername();
                        ?>
                        <img src="<?= $userImage ?>" alt="<?= $username ?>" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <h4 id="nombre_Inst">
                            <?php echo $user->getUsername() ?>
                        </h4>
                        <h6>
                            <?php echo $user->getNombres() . " " . $user->getApellidos(); ?>
                        </h6>
                        <h6>
                            <?= $user->getEmail() ?>
                        </h6>
                        <h6>
                            <?php $formattedFechaNacimiento = date('d \d\e F \d\e\l Y', strtotime($user->getFechaNacimiento()));
                            echo $formattedFechaNacimiento; ?>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-secondary m-2" data-bs-toggle="modal" data-bs-target="#editProfile">Editar
                            perfil</a>
                        <a class="btn btn-secondary m-2" data-bs-toggle="modal" data-bs-target="#changePhoto">Cambiar
                            foto</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal editar perfil-->
        <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="edit-profile-title" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit-profile-title">Editar perfil</h4>
                    </div>
                    <form action="" id="edit-profile-modal">
                        <div class="modal-body">

                            <label for="edit-username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="edit-username" name="username"
                                value="<?php echo $user->getUsername(); ?>">
                            <span class="text-danger" id="fusername_error_message"></span><br>

                            <label for="edit-name" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="edit-name" name="name"
                                value="<?php echo $user->getNombres(); ?>">
                            <span class="text-danger" id="fname_error_message"></span><br>
                            <label for="edit-last-name" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="edit-last-name" name="edit-last-name"
                                value="<?php echo $user->getApellidos(); ?>">
                            <span class="text-danger" id="sname_error_message"></span><br>
                            <label for="edit-gender" class="form-label">Género</label>
                            <select class="form-select" id="edit-gender" name="edit-gender">
                                <?php
                                if ($user->getSexo() == 'Mujer') { ?>
                                    <option>Hombre</option>
                                    <option selected>Mujer</option>
                                    <option>Otro</option>
                                <?php } else if ($user->getSexo() == 'Hombre') { ?>
                                        <option selected>Hombre</option>
                                        <option>Mujer</option>
                                        <option>Otro</option>
                                <?php } else if ($user->getSexo() == 'Otro') { ?>
                                            <option>Hombre</option>
                                            <option>Mujer</option>
                                            <option selected>Otro</option>
                                <?php }
                                ?>
                            </select>
                            <span class="text-danger" id="gender_error_message"></span><br>

                            <div style="display: none;">
                                <label for="edit-mod" class="form-label">Modalidad</label>
                                <select class="form-select" id="edit-mod" name="edit-mod">
                                    <option>Privado</option>
                                    <option selected>Público</option>
                                </select>
                                <span class="text-danger" id="mod_error_message"></span><br>
                            </div>

                            <label for="edit-birthday" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="edit-birthday" name="edit-birthday"
                                min="1903-01-01" value="<?php echo $user->getFechaNacimiento(); ?>">
                            <span class="text-danger" id="birthday_error_message"></span><br>
                            <label for="edit-email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="edit-email" name="edit-email"
                                value="<?php echo $user->getEmail(); ?>">
                            <span class="text-danger" id="email_error_message"></span><br>
                            <label for="edit-password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="edit-password" name="edit-password"
                                value="<?php echo $user->getContrasena(); ?>">
                            <span class="text-danger" id="password_error_message"></span><br>
                            <label for="retype-password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="retype-password" name="retype-password">
                            <span class="text-danger" id="confirm_password_error_message"></span><br>
                            <span class="text-danger" id="modal_error_message"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary" id="save-changes" name="save-changes">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cambiar photo -->
        <div class="modal fade" id="changePhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Cambiar foto</h4>
                    </div>
                    <form action="" id="change-photo-form">
                        <div class="modal-body">
                            <div class="wrapper">
                                <div class="box">
                                    <div class="input-bx">
                                        <label for="Upload" class="uploadlabel" id="img-holder">
                                            <span class=""><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                            <p>Añade una imagen</p>
                                        </label>
                                        <img src="" id="preview-img" alt="">
                                        <input type="file" id="Upload" class="form-control mt-3">
                                        <span class="text-danger" id="photo_error_message"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="close-btn" type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button id="save-btn" type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include('./components/footer.php'); ?>


        <?php include_once "./libs/sweetalertJS.php" ?>
        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <script src="./js/POV_Perfil_Admin.js"></script>
        <script src="./js/Profile_edition.js"></script>

    </main>
</body>

</html>