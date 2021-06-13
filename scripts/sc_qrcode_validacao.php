<?php
include_once "../connections/connection.php";
session_start();
$organizacao=$_SESSION['organizacao'];

if(isset($_POST['conteudo'])){
    echo $organizacao;
    echo $_POST['conteudo'];

    $link = new_db_connection(); // Create a new DB connection

    $stmt = mysqli_stmt_init($link); // create a prepared statement

    $query = "SELECT qrCode FROM organizacoes WHERE idOrganizacoes= ?"; // Define the query

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, 'i', $organizacao);

        mysqli_stmt_execute($stmt); // Execute the prepared statement

        mysqli_stmt_bind_result($stmt, $qrcode);

        if (!mysqli_stmt_fetch($stmt)){

            echo("Error description: " . mysqli_error($link));
        }
        else{
           if($qrcode===$_POST['conteudo']){
               header("Location:../mapa.php");
               mysqli_stmt_close($stmt); // Close statement
               mysqli_close($link);
           }else{

               header("Location:../QR_code.php?msg=1");
           }

        }

    }else {
        echo("Error description: " . mysqli_error($link));
    }
};
?>