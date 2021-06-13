<?php
session_start();

require_once("connections/connection.php");

$id_user = $_SESSION['iduser'];

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "SELECT count(idNotificacoes), estado FROM notificacoes
              WHERE Utilizadores_idUtilizadores = ? and estado = 1";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $id_user);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_bind_result($stmt, $idnot, $estado);

        while (mysqli_stmt_fetch($stmt)) {
            echo $idnot;
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);