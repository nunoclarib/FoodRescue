<?php
if(isset($_POST['grandeza']) && isset($_POST['abreviatura']) && $_POST['grandeza']!="" && $_POST['abreviatura']!="") {

    $grandeza=htmlspecialchars($_POST['grandeza']);
    $abreviatura= htmlspecialchars($_POST['abreviatura']);

    require_once "../connections/connection.php";
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query="INSERT INTO grandezas (idGrandezas,grandeza, abreviatura_gr) VALUES(?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, "iss", $id_grandeza, $grandeza, $abreviatura);

        mysqli_stmt_execute($stmt); // Execute the prepared statement


        mysqli_stmt_close($stmt); // Close statement
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    mysqli_close($link); // Close connection

}
header("Location:../pages/grandezas.php");


?>