<?php

if(isset($_GET['id_user'])){

    include_once "../connections/connection.php";
    $id_user=$_GET['id_user'];
    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM utilizadores WHERE idUtilizadores = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {


        mysqli_stmt_bind_param($stmt, "i", $id_user);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }


        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);

}

header("Location:../pages/users.php");


?>