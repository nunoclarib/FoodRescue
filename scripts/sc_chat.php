<?php
session_start();
require_once('../connections/connection_chat.php');

if (isset($_SESSION['idchat'])) {

    $id_destino = $_SESSION['idchat'];

    if (isset($_SESSION['iduser']) && isset($_POST['mensagem']) && $_POST['mensagem'] != '') {
        $iduser = $_SESSION['iduser']; //coloca o nome digitada na variavel nome
        $mensagem = $_POST['mensagem']; //coloca a mensagem na varivavel mensagem

        $sql = $pdo->query("INSERT INTO chat SET utilizadores_idUtilizadores= '$iduser', mensagem= '$mensagem', id_destino = '$id_destino'");

        header('Location: ../index_chat.php');

    } else {
        echo 'mensagem de erro';
        header('Location: ../index_chat.php');
    }


    if (isset($_POST['mensagem']) && $_POST['mensagem'] != '') {
        require_once "../connections/connection.php";

        $tiulo = 'Nova Mensagem no Chat';
        $texto = 'Tens uma nova mensagens no chat!';
        $direction = 'index_chat.php?id='.$iduser;
        $estado = 1;


        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        $query = "INSERT INTO notificacoes(titulo_not, texto_notif, 
              estado ,direction, Utilizadores_idUtilizadores) VALUES(?,?,?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'ssisi', $tiulo, $texto, $estado, $direction, $id_destino);

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error:" . mysqli_error($link);
            mysqli_close($link);
        }
    }

}

?>