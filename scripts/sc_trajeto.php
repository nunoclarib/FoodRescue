<?php
session_start();

if (isset($_POST['estab'])) {

    $coordenadas = $_POST['estab'];
    list($latitude1, $longitude1) = explode(',', $coordenadas);

    echo $latitude1;
    echo $longitude1;

    require_once "../connections/connection.php";

    $iduser = $_SESSION['iduser'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT Utilizadores_idUtilizadores FROM estabelecimentos WHERE latitude = ? and longitude = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ss', $latitude1, $longitude1);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $idforn);

            if( mysqli_stmt_fetch($stmt)){
                $tiulo = 'Um Voluntário Aceitou a Recolha';
                $texto = 'Um voluntário aceitou recolher os seus excedentes';
                $direction = 'mapa.php?id=' . $idforn;
                $estado = 1;

                $link2 = new_db_connection();

                $stmt2 = mysqli_stmt_init($link2);

                $query2 = "INSERT INTO notificacoes(titulo_not, texto_notif,
                              estado ,direction, notificacoes.Utilizadores_idUtilizadores) VALUES(?,?,?,?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {

                    mysqli_stmt_bind_param($stmt2, 'ssisi', $tiulo, $texto, $estado, $direction, $idforn);

                    if (mysqli_stmt_execute($stmt2)) {

                    } else {
                        echo 'erro';
                        echo "Error:" . mysqli_stmt_error($stmt2);
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    echo 'hh';
                    echo "Error:" . mysqli_error($link2);
                    mysqli_close($link2);
                }
            }



        } else {

            echo 'oi';
            echo "Error:" . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'não dá';
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }

}

header ('Location: ../mapa.php');
?>