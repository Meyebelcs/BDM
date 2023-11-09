<?php
if (!isset($_SESSION["AUTH"])) {
    header("Location: landingPage.php");
    exit;
}

require_once "../models/User.php";
require_once "../db.php";
$idUser = $_SESSION["AUTH"];
$mysqli = db::connect();
$user = User::findUserById($mysqli, (int) $idUser);

/* ---------Reedireccionamiento a perfil------------ */
$rol = $user->getRol();
$urlPerfil = '';

if ($rol == 'Vendedor') {
    $urlPerfil = "POV_Perfil_Vendedor.php";
} else if ($rol == 'Comprador') {
    $urlPerfil = "POV_Perfil_Cliente.php";
} else if ($rol == 'Administrador') {
    $urlPerfil = "POV_Perfil_Admin.php";
}