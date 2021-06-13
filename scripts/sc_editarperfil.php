<?php
session_start();
// Falta verificar se existem os outros campos do formulário
if (isset($_POST["password"]) && $_POST["password"] != '' && isset($_POST["name"]) && isset($_POST["apelido"]) && isset($_POST["username"]) && isset($_POST["email"]) && $_POST["name"] != ''
    && $_POST["apelido"] != '' && $_POST["username"] != '' && $_POST["email"] != '' && isset($_POST['morada']) && $_POST['morada'] !=''
    && isset($_POST['nome_estab']) && $_POST['nome_estab'] !='' && isset($_POST['hora_abertura']) && $_POST['hora_abertura'] !=''
    && isset($_POST['hora_fecho']) && $_POST['hora_fecho'] !='') {


    $nome = htmlspecialchars($_POST["name"]);
    $apelido = htmlspecialchars($_POST["apelido"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);


    require_once("../connections/connection.php");

    $id = $_SESSION['iduser'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash FROM utilizadores WHERE idUtilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash);

            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {


                    $link2 = new_db_connection();

                    $stmt2 = mysqli_stmt_init($link2);

                    $query2 = "UPDATE utilizadores
                  SET nome = ?, apelido = ?, username = ?, email = ?
                  WHERE idUtilizadores = ?";

                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                        mysqli_stmt_bind_param($stmt2, "ssssi", $nome, $apelido, $username, $email, $id);

                        if (!mysqli_stmt_execute($stmt2)) {

                            echo "Error:" . mysqli_stmt_error($stmt2);
                        }

                        mysqli_stmt_close($stmt2);
                    }

                    $morada = $_POST['morada'];
                    $hora_abertura = $_POST["hora_abertura"];
                    $hora_fecho = $_POST["hora_fecho"];
                    $nome_estab = $_POST["nome_estab"];

                    $link3 = new_db_connection();

                    $stmt3 = mysqli_stmt_init($link3);

                    $query3 = "UPDATE estabelecimentos
                  SET nome_estab = ?, morada=?, hora_abertura = ?, hora_fecho = ?
                  WHERE Utilizadores_idUtilizadores = ?";

                    if (mysqli_stmt_prepare($stmt3, $query3)) {

                        mysqli_stmt_bind_param($stmt3, "ssssi", $nome_estab, $morada, $hora_abertura, $hora_fecho, $id);

                        if (!mysqli_stmt_execute($stmt3)) {

                            echo "Error:" . mysqli_stmt_error($stmt3);

                        }
                        mysqli_stmt_close($stmt3);

                    } else {
                        header("Location:../editarperfil.php");
                    }
                    mysqli_close($link3);


                } else {
                    echo("Error description: " . mysqli_error($link2));
                }
                mysqli_close($link2);

            }
            mysqli_stmt_close($stmt);
        } else {
            echo("Error description: " . mysqli_error($link));
        }


    }
    mysqli_close($link);
}
header("Location: ../perfil.php");