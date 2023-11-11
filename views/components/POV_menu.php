<?php

if (!isset($_SESSION["AUTH"])) {
    header("Location: landingPage.php");
    exit;
}

require_once "../models/User.php";
require_once "../models/Categoria.php";
require_once "../db.php";
$idUser = $_SESSION["AUTH"];
$mysqli = db::connect();
$user = User::findUserById($mysqli, (int) $idUser);

/* --------- categorias------------ */
$categorias = Categoria::getAllCategorias($mysqli);

/* ---------Reedireccionamiento a perfil------------ */
$rol = $user->getRol();
$urlPerfil = '';
$titulo = '';
$url = '';

switch ($perfil) {
    case "PerfilAdmin":
        if ($rol == 'Administrador') {
            $urlPerfil = "POV_Perfil_Admin.php";
            $url = 'Admin_Cotizaciones.php';
            $titulo = 'Autorizaciones';
        } else {
            redirectToHome();
        }
        break;

    case "PerfilCliente":
        if ($rol == 'Comprador') {
            $urlPerfil = "POV_Perfil_Cliente.php";
            $url = "POV_Perfil_Cliente.php";
            $titulo = "Mis Compras";
        } else {
            redirectToHome();
        }
        break;

    case "PerfilVendedor":
        if ($rol == 'Vendedor') {
            $urlPerfil = "POV_Perfil_Vendedor.php";
            $url = "POV_Perfil_Vendedor.php";
            $titulo = "Mis Ventas";
        } else {
            redirectToHome();
        }
        break;

    default:
        redirectToHome();
        break;
}

function redirectToHome()
{
    header("Location: home.php");
    exit;
}
