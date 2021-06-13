<?php

session_start();
if(isset($_GET['id_grandeza'])){


    include_once "../connections/connection.php";
    $id_grandeza=$_GET['id_grandeza'];
    echo $id_grandeza;

    $link = new_db_connection();


    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM grandezas WHERE idGrandezas = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $id_grandeza);
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

}
header("Location:../pages/grandezas.php");


?>