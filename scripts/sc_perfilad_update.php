<?php
session_start();
if(isset($_SESSION['iduser'])  && isset($_POST['nome']) && isset($_POST['apelido']) && isset($_POST['username'])
        && isset($_POST['contacto']) && isset($_POST['email']) && $_POST['nome']!="" && $_POST['apelido']!="" && $_POST['username']!="" && $_POST['contacto']!="" && $_POST['email']!=""){

    $iduser=$_SESSION['iduser'];
    $nome= htmlspecialchars($_POST['nome']);
    $apelido= htmlspecialchars($_POST['apelido']);
    $username= htmlspecialchars($_POST['username']);
    $contacto= htmlspecialchars($_POST['contacto']);
    $email= htmlspecialchars($_POST['email']);


    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE utilizadores
              SET nome=?,
              apelido=?,
              email=?,
              contacto=?,
              username=?
              WHERE  idUtilizadores=?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "sssisi",$nome, $apelido , $email, $contacto, $username,  $iduser);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {

            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../pages/index.php");
        } else {

            header("Location: ../pages/perfil.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);
} else{

    header("Location: ../pages/perfil.php");
}

?>

