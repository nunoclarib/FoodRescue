<?php

require_once ("../connections/connection.php");


if (isset($_POST['username']) && ($_POST['username']) != '' && isset($_POST['id_users']) && ($_POST['id_users']) != '' && isset($_POST['email']) && ($_POST['email']) != '' && isset($_POST['id_roles'])){

    $username = htmlspecialchars($_POST['username']);
    $id_user = htmlspecialchars($_POST['id_users']);
    $email = htmlspecialchars($_POST['email']);
    $perfil = htmlspecialchars($_POST['id_roles']);
    $active = htmlspecialchars($_POST['active']);

    if ($active == 'on')
    {
        $activado = 1;
    }else{
        $activado = 0;
    }

    //echo $username, $id_user, $email, $perfil, $active, $activado;


    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = 'UPDATE utilizadores
              SET username = ?, email = ?, Perfis_idPerfis = ?, active = ?
              WHERE idUtilizadores = ?';

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "ssisi", $username,  $email, $perfil, $activado, $id_user);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            require_once '../pages/404.php';
        }
        else{
            header("Location: ../pages/users.php");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);

}
