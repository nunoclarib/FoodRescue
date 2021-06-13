<?php
include_once '../connections/connection.php';

if (isset($_POST["nome"]) && isset($_POST["apelido"]) && isset($_POST["mail"]) && isset($_POST["contacto"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["id_organizacao"])
&& $_POST["nome"] != "" && $_POST["apelido"] != "" && $_POST["mail"] != "" && $_POST["contacto"] != "" && $_POST["username"] != ""
    && $_POST["password"] != "" && $_POST["id_organizacao"] != "" ) {

    $nome = htmlspecialchars($_POST["nome"]);
    $apelido = htmlspecialchars($_POST["apelido"]);
    $contacto = htmlspecialchars($_POST["contacto"]);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['mail']);
    $organizacao = htmlspecialchars($_POST['id_organizacao']);
    $password_hash = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores (nome, apelido, email, contacto, username, password_hash, Perfis_idPerfis, Organizacoes_idOrganizacoes)
              VALUES (?,?,?,?,?,?,2,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssissi', $nome, $apelido, $email, $contacto, $username, $password_hash, $organizacao);

        // Devemos validar também o resultado do execute!
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // Acção de sucesso

        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../registo_volun.php?msg=1#registo");
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    header("Location: ../registo_volun.php?msg=2#registo");
}
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

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
            $_SESSION['organizacao'] = $organizacao;

            header('Location: ../registo_volun_pic.php');

            mysqli_stmt_close($stmt2);
        }
    }
}
mysqli_close($link2);
