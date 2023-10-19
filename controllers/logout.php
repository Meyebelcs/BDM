<?php

//Imporante inicializar la sesion antes de destruirla
session_start();
session_destroy();

header("Location: ../views/landingPage.php");

exit;