<?php
if(isset($_POST['nome']) && isset($_POST['morada']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['qrcode'])
    && $_POST['nome']!="" && $_POST['morada']!="" && $_POST['latitude']!="" && $_POST['longitude']!="" && $_POST['qrcode']!=""){

    $nome=htmlspecialchars($_POST['nome']);
    $morada= htmlspecialchars($_POST['morada']);
    $latitude= htmlspecialchars($_POST['latitude']);
    $longitude= htmlspecialchars($_POST['longitude']);
    $qrcode= htmlspecialchars($_POST['qrcode']);

    require_once "../connections/connection.php";
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query="INSERT INTO organizacoes (idOrganizacoes,nome_organizacao, morada,latitude, longitude,qrCode) VALUES(?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, "issiis", $id_org, $nome, $morada, $latitude, $longitude, $qrcode);

        mysqli_stmt_execute($stmt); // Execute the prepared statement


        mysqli_stmt_close($stmt); // Close statement
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    mysqli_close($link); // Close connection

}
header("Location:../pages/org.php");


?>