<?php
include_once '../connections/connection.php';

if (isset($_POST["nome"]) && isset($_POST["apelido"]) && isset($_POST["mail"]) && isset($_POST["contacto"]) && isset($_POST["username"]) && isset($_POST["password"])
&& $_POST["nome"]!="" && $_POST["apelido"]!="" && $_POST["mail"]!="" && $_POST["contacto"]!="" && $_POST["username"]!="" && $_POST["password"]!=""
) {

    $nome = htmlspecialchars($_POST["nome"]);
    $apelido = htmlspecialchars($_POST["apelido"]);
    $contacto = htmlspecialchars($_POST["contacto"]);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['mail']);
    $password_hash = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores (nome, apelido, email, contacto, username, password_hash, Perfis_idPerfis)
              VALUES (?,?,?,?,?,?,3)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssiss', $nome, $apelido, $email, $contacto, $username, $password_hash);

        // Devemos validar também o resultado do execute!
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);

            // Acção de sucesso
            $stmt2 = mysqli_stmt_init($link);

            $query2 = "SELECT idUtilizadores, Perfis_idPerfis FROM utilizadores WHERE username LIKE ?";

            if (mysqli_stmt_prepare($stmt2, $query2)) {
                mysqli_stmt_bind_param($stmt2, 's', $username);

                if (mysqli_stmt_execute($stmt2)) {

                    mysqli_stmt_bind_result($stmt2, $id_user, $perfil);
                    if (mysqli_stmt_fetch($stmt2)) {
                        // Guardar sessão de utilizador
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION['iduser'] = $id_user;
                        $_SESSION['perfil'] = $perfil;

                        mysqli_stmt_close($stmt2);
                        mysqli_close($link);


                        header('Location: ../registo_forn_pic.php');

                    }
                }
            }

        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../registo_forn.php?msg=0#login");
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    header("Location: ../registo_forn.php?msg=2#registo");
}
