<?php
require_once "../connections/connection.php";

if (isset($_POST["username"]) && isset($_POST["password"])
    && $_POST['username'] != "" && $_POST['password'] != "") {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash, idUtilizadores, Perfis_idPerfis, active FROM utilizadores WHERE username LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $username);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash, $iduser, $perfil, $active);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION['iduser'] = $iduser;
                    $_SESSION['perfil'] = $perfil;
                    if ($active != 0) {
                        if ($_SESSION['perfil'] == 1) {
                            header('Location: ../pages/index.php');
                        } else {
                            header('Location: ../mapa.php');
                        }
                    } else {
                        header('Location: ../login.php');
                    }

                } else {
                    // Password está errada
                    header("Location: ../login.php?msg=3#login");

                }
            } else {
                // Username não existe
                header("Location: ../login.php?msg=4#login");

            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    header("Location: ../login.php?msg=2#login");
}


