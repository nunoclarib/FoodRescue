<?php
session_start();

if(isset($_POST['id_org']) && isset($_POST['nome']) && isset($_POST['morada']) && isset($_POST['qrcode'])
&& $_POST['nome']!=" " && $_POST['morada']!=" " && $_POST['qrcode']!=" "){

    $id_org= htmlspecialchars($_POST['id_org']);
    $nome_org= htmlspecialchars($_POST['nome']);
    $morada_org= htmlspecialchars($_POST['morada']);
    $qrcode= htmlspecialchars($_POST['qrcode']);

    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE organizacoes
              SET nome_organizacao = ?,
              morada = ?,
              qrCode= ?
              WHERE  idOrganizacoes=?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "sssi",$nome_org, $morada_org, $qrcode, $id_org );
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../pages/index.php");
        } else {

            header("Location: ../pages/org.php");
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
