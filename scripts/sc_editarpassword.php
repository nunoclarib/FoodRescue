<?php
require_once '../connections/connection.php';

if (isset($_POST['id_users']) && ($_POST['id_users']) != '' && isset($_POST['password_atual']) && ($_POST['password_atual']) != '' && isset($_POST['password_nova']) && ($_POST['password_nova']) != '' ){

    $id_user = htmlspecialchars($_POST['id_users']);
    $password_atual = htmlspecialchars($_POST['password_atual']);
    $password_nova = htmlspecialchars(password_hash($_POST['password_nova'], PASSWORD_DEFAULT));

    $upd_pass = false;



    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash FROM utilizadores WHERE idUtilizadores LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password_atual, $password_hash)) {
                    // Feedback de sucesso

                    echo 'oi';



                    $upd_pass = true;


                } else {
                    // Password está errada
                    header("Location: ../pages/404.php");

                }
            } else {
                // Id não existe
                header("Location: ../pages/404.php");

            }
            mysqli_stmt_close($stmt);
        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);

    }

    if ($upd_pass == true){

        
        $stmt2 = mysqli_stmt_init($link);

        $query2 = 'UPDATE utilizadores
              SET password_hash = ?
              WHERE idUtilizadores = ?';

        if (mysqli_stmt_prepare($stmt2, $query2)) {
            /* Bind paramenters */
            mysqli_stmt_bind_param($stmt2, "si", $password_nova,   $id_user);
            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt2)) {
                echo "Error:" . mysqli_stmt_error($stmt2);
                require_once '../pages/404.php';
            }
            else{
                header("Location: ../perfil.php");
            }

            /* close statement */
            mysqli_stmt_close($stmt2);
        } else {
            echo("Error description: " . mysqli_error($link));
        }


    }


    mysqli_close($link);
}