<?php

session_start();
if(isset($_SESSION['iduser']) && isset($_POST['alimento']) && isset($_POST['quantidade']) && isset($_POST['grandeza']) && isset($_POST['msg'])
 && $_POST['alimento']!= "" && $_POST['quantidade']!= "" && $_POST['grandeza']!= "" && $_POST['msg']!= ""){



    $alimento=htmlspecialchars($_POST['alimento']);
    $quantidade=htmlspecialchars($_POST['quantidade']);
    $grandeza=htmlspecialchars($_POST['grandeza']);
    $msg=htmlspecialchars($_POST['msg']);
    $iduser=htmlspecialchars($_SESSION['iduser']);



    include_once "../connections/connection.php";
    $link=new_db_connection();

    $stmt2= mysqli_stmt_init($link);
    $query2= "SELECT idEstabelecimentos FROM estabelecimentos where Utilizadores_idUtilizadores=? ";
    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, "i", $iduser);
        if (mysqli_stmt_execute($stmt2)) {
            mysqli_stmt_bind_result($stmt2, $estabelecimento);

            if(mysqli_stmt_fetch($stmt2)){
                echo"$estabelecimento";
            }
        }
        mysqli_stmt_close($stmt2); // Close statement

    }else{
        echo("Error description: " . mysqli_error($link));
    }

    $stmt= mysqli_stmt_init($link);
    $query="INSERT INTO excedentes(excedente, quantidade, nota, grandezas_idGrandezas, Estabelecimentos_idEstabelecimentos) VALUES(?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        echo"nice";

        mysqli_stmt_bind_param($stmt, "sisii", $alimento, $quantidade, $msg, $grandeza, $estabelecimento);


        mysqli_stmt_execute($stmt); // Execute the prepared statement


        mysqli_stmt_close($stmt); // Close statement
    } else {
        echo"erro";
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link); // Close connection
    header("Location: ../mapa.php");
}
else{
    header("Location: ../comunicar_excedentes.php");
}



?>
