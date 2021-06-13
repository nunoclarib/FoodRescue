<?php
if (!isset($_SESSION)) {
    session_start();

}
if (isset($_SESSION["username"])) {

    unset($_SESSION["username"]);
    unset($_SESSION['iduser']);
    unset($_SESSION['perfil']);
    unset($_SESSION['idchat']);

}
header('Location: ../login_registo.php');
