<?php

if(isset($_GET['id_org'])){


    include_once "../connections/connection.php";
    $id_org=$_GET['id_org'];
    $link = new_db_connection();


    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM organizacoes WHERE idOrganizacoes = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $id_org);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);

        }

        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);

}header("Location:../pages/org.php");


?>