<?php
session_start();

if(isset($_POST['id_estab']) && isset($_POST['nome']) && isset($_POST['morada']) && isset($_POST['descricao']) && isset($_POST['horaabertura']) && isset($_POST['horafecho'])
    && isset($_POST['id_utilizador'])
    && $_POST['nome']!=" " && $_POST['morada']!=" " && $_POST['descricao']!=" " && $_POST['horaabertura']!=" "  && $_POST['horafecho']!=" "){

    $id_estab= htmlspecialchars($_POST['id_estab']);
    $nome_estab= htmlspecialchars($_POST['nome']);
    $morada_estab= htmlspecialchars($_POST['morada']);
    $descricao= htmlspecialchars($_POST['descricao']);
    $hora_ab= htmlspecialchars($_POST['horaabertura']);
    $hora_f= htmlspecialchars($_POST['horafecho']);
    $id_utilizadores= htmlspecialchars($_POST['id_utilizador']);

    require_once ("../connections/connection.php");

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE estabelecimentos
              SET nome_estab = ?,
              morada = ?,
              descricao=?,
              hora_abertura=?,
              hora_fecho=?,
              Utilizadores_idUtilizadores=?
              WHERE  idEstabelecimentos=?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "sssssii",$nome_estab, $morada_estab , $descricao, $hora_ab, $hora_f, $id_utilizadores, $id_estab);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../pages/index.php");

        } else {
            header("Location: ../pages/estabelecimentos.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);
} else{

    header("Location: ../pages/estabelecimentos.php");

}

?>

