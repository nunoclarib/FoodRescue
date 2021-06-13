<?php

session_start();
if(isset($_GET['id_estab'])){


    include_once "../connections/connection.php";
    $id_estab=$_GET['id_estab'];
    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM estabelecimentos WHERE idEstabelecimentos = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $id_estab);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
        /* close statement */

        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);

}header("Location:../pages/estabelecimentos.php");


?>