<?php
session_start();

if(isset($_POST['id_grandeza']) && isset($_POST['grandeza']) && isset($_POST['abreviatura']) && $_POST['grandeza']!=" " && $_POST['abreviatura']!=" " ){

    $id_grandeza= htmlspecialchars($_POST['id_grandeza']);
    $grandeza= htmlspecialchars($_POST['grandeza']);
    $abreviatura= htmlspecialchars($_POST['abreviatura']);

    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE grandezas
              SET grandeza = ?,
              abreviatura_gr = ?
              WHERE  idGrandezas=?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "ssi",$grandeza, $abreviatura, $id_grandeza );
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../pages/index.php");
        } else {

            header("Location: ../pages/grandezas.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));

    }
    /* close connection */
    mysqli_close($link);
} else{
    header("Location: ../pages/index.php");


}

?>
