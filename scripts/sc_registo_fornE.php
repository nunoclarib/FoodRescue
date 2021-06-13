<?php
include_once '../connections/connection.php';
session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["iduser"]) && isset($_SESSION["perfil"])) {
    $username = $_SESSION["username"];
    $id_user = $_SESSION["iduser"];
    $perfil = $_SESSION["perfil"];

    if (isset($_POST['nome_estabelecimento']) && isset($_POST['morada_estabelecimento']) && isset($_POST['descricao_estabelecimento']) && isset($_POST['hora_abertura']) && isset($_POST['hora_fecho'])
        && $_POST['nome_estabelecimento'] != "" && $_POST['morada_estabelecimento'] != "" && $_POST['descricao_estabelecimento'] != "" && $_POST['nome_estabelecimento'] != ""
        && $_POST['hora_abertura'] != "" && $_POST['hora_fecho'] != "" && isset ($_POST['Coordenadas']) && $_POST['Coordenadas'] != '') {

        $nome_estab = htmlspecialchars($_POST['nome_estabelecimento']);
        $morada = htmlspecialchars($_POST['morada_estabelecimento']);
        $descricao = htmlspecialchars($_POST['descricao_estabelecimento']);
        $hora_abertura = htmlspecialchars($_POST['hora_abertura']);
        $hora_fecho = htmlspecialchars($_POST['hora_fecho']);

        //separar coordenadas
        $coordenadas = $_POST['Coordenadas'];
        list($latitude1, $longitude1) = explode(',', $coordenadas);
        list($longitude) = explode(')', $longitude1);
        $latitude = substr($latitude1, 1);

        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        $query = "INSERT INTO estabelecimentos (nome_estab, morada, descricao, hora_abertura, hora_fecho, latitude, longitude, Utilizadores_idUtilizadores) VALUES (?,?,?,?,?,?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssssssi', $nome_estab, $morada, $descricao, $hora_abertura, $hora_fecho, $latitude, $longitude, $id_user);

            // Devemos validar também o resultado do execute!
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);

                mysqli_close($link);

                header('Location: ../registo_estab_pic.php');
            }
        }

    } else {
        header("Location: ../registo_estab.php?msg=2#estabelecimento");
    }

};