<?php
session_start();

if(isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    echo $iduser;
    include_once "../connections/connection.php";
    echo"olá";

    // Create a new DB connection
   $link = new_db_connection();
   echo"ola";

    /* create a prepared statement */
   $stmt = mysqli_stmt_init($link);

    $query = "UPDATE excedentes
              SET utilizadores_idUtilizadores = NULL 
              WHERE  utilizadores_idUtilizadores=?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $iduser);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../historico_recolhas.php");
        } else {

            header("Location: ../historico_recolhas.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo"foda-se";
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
   mysqli_close($link);

} else{
    header("Location: ../mapa.php");

};

?>
