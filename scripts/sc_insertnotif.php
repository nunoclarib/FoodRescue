<?php
require_once "../connections/connection.php";
session_start();

$_SESSION['iduser'] = $iduser;
$titulo = htmlspecialchars($_POST['titulo']);
$texto = htmlspecialchars($_POST['texto']);
$direction = htmlspecialchars($_POST['direction']);
$estado = htmlspecialchars($_POST['estado']);

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "INSERT INTO notificacoes(titulo_not, texto_notif, 
          direction, estado, Utilizadores_idUtilizadores) VALUES(?,?,?,?,?)";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'sssii', $titulo,$texto, $direction, $estado, $iduser);

    if (mysqli_stmt_execute($stmt)) {
        echo 'ok';
    } else {
        echo "Error:" . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {

    echo "Error:" . mysqli_error($link);
    mysqli_close($link);
}
