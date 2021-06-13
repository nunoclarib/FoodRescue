<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "O ficheiro é muito grande, terá de ter menos de 13MB!";
            $class = "alert-warning";
            $upload = true;
            break;
        case 1:
            $message = "Erro ao realizar o upload.";
            $class = "alert-danger";
            $upload = true;
            break;
        case 2:
            $message = "Este tipo de ficheiro não é suportado.";
            $class = "alert-warning";
            $upload = true;
            break;
        case 3:
            $message = "Não foi submetido nenhum ficheiro...";
            $class = "alert-warning";
            $upload = true;
            break;
        default:
            $msg_show = false;
    }
}


?>
<section class="container-fluid">

    <br><br><br><br>

    <?php
    require_once 'connections/connection.php';

    $id_user = $_SESSION['iduser'];
    $perfil = $_SESSION['perfil'];

    if ($perfil == 2) {


        $link = new_db_connection(); // Create a new DB connection

        $stmt2 = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT foto_pessoal FROM utilizadores WHERE idUtilizadores = ?"; // Define the query

        if (mysqli_stmt_prepare($stmt2, $query)) { // Prepare the statement

            mysqli_stmt_bind_param($stmt2, 'i', $id_user);

            mysqli_stmt_execute($stmt2); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt2, $imagem);

            while (mysqli_stmt_fetch($stmt2)) {

                if ($imagem != NULL) {

                    echo '
               <img src="img/voluntario_cover.jpg" class="capa_forn mt-5" style=\'position:absolute; top:0px; left:0px;\'>
<div class="text-center" style=\'position:absolute; left:23%\'>
        <img src="uploads/' . $imagem . '" class="arredondamento tamanho_img mt-5">';
                } else {
                    echo '<img src="img/voluntario_cover.jpg" class="capa_forn mt-5" style=\'position:absolute; top:0px; left:0px;\'>
<div class="text-center" style=\'position:absolute; left:23%\'>
        <img src="img/img_avatar5.png" class="arredondamento tamanho_img mt-5">';
                }

            }

            mysqli_stmt_close($stmt2); // Close statement
        } else {
            echo("Error description: " . mysqli_error($link));
        }
    }

    if ($perfil == 3) {
        $link = new_db_connection(); // Create a new DB connection

        $stmt2 = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT foto_pessoal, fot_estab FROM utilizadores INNER JOIN estabelecimentos ON idUtilizadores = Utilizadores_idUtilizadores
              WHERE idUtilizadores = ?"; // Define the query

        if (mysqli_stmt_prepare($stmt2, $query)) { // Prepare the statement

            mysqli_stmt_bind_param($stmt2, 'i', $id_user);

            mysqli_stmt_execute($stmt2); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt2, $imagem, $img_estab);

            while (mysqli_stmt_fetch($stmt2)) {
                if ($imagem != NULL) {
                    if ($img_estab != NULL) {
                        echo '<img src="uploads/' . $img_estab . '" class="capa_forn mt-5" style=\'position:absolute; top:0px; left:0px;\'>
<div class="text-center" style=\'position:absolute; left:23%\'>';
                    } else {
                        echo '<img src="img/restaurant-interior.jpg" class="capa_forn" style=\'position:absolute; top:0px; left:0px;\'>
<div class="text-center" style=\'position:absolute; left:23%\'>';
                    }
                    echo '<img src="uploads/' . $imagem . '" class="arredondamento tamanho_img mt-5">';
                } else {
                    echo '<img src="img/restaurant-interior.jpg" class="capa_forn" style=\'position:absolute; top:0px; left:0px;\'>
<div class="text-center" style=\'position:absolute; left:23%\'>
        <img src="img/img_avatar.png" class="arredondamento tamanho_img mt-5">';
                }

            }

            mysqli_stmt_close($stmt2); // Close statement
        } else {
            echo("Error description: " . mysqli_error($link));
        }
    }

    if ($_SESSION['perfil'] == 3) {
        echo '<h1 class=" font-weight-bold mt-2">Fornecedor</h1>';
    }
    if ($_SESSION['perfil'] == 2) {
        echo '<h1 class=" font-weight-bold mt-2">Voluntário</h1>';
    }
    ?>


    </div><br><br><br><br><br><br><br><br><br><br>
    <div>
        <?php
        if (isset($_GET["msg"]) && $upload == true) {
            echo "<br><div id='alertmsg' class=\"alert $class alert-dismissible fade show\" role=\"alert\">
                 " . $message . "
                 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                 <span aria-hidden=\"true\">&times;</span>
                 </button>
                 </div>";
            if ($msg_show) {
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        } ?>

        <form method="post" action="upload_fotoperfil.php" enctype="multipart/form-data">
            <input type="file" name="fileupload"><br><br>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-info">Submeter imagem</button>
            </div>
        </form>

        <form method="post" action="scripts/sc_editarperfil.php" class="mt-3">
            <?php

            $perfil = $_SESSION['perfil'];
            $iduser = $_SESSION['iduser'];


            if (isset($iduser) && isset($perfil)) {

                if ($perfil == 2) {
                    $id = $_SESSION['iduser'];

                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT nome, apelido, username, email, nome_organizacao FROM utilizadores
  INNER JOIN organizacoes ON idOrganizacoes = Organizacoes_idOrganizacoes
  WHERE idUtilizadores = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $id);

                        if (mysqli_stmt_execute($stmt)) {

                            mysqli_stmt_bind_result($stmt, $nome, $apelido, $username, $email, $org);

                            if (mysqli_stmt_fetch($stmt)) {
                                echo '
<h3 class="font-weight-bold mt-2">Nome</h3>
<input type="text" name="name" class="form-control mb-0" value="' . $nome . '" >

<h3 class="font-weight-bold mt-5">Apelido</h3>
<input type="text" value="' . $apelido . '" name="apelido" class="form-control mb-0">

<h3 class="font-weight-bold mt-5">Username</h3>
<input type="text" value="' . $username . '" name="username" class="form-control mb-0">
                      
<h3 class="font-weight-bold mt-5">Email</h3>
                                <div class="col-xs-8">
                                    <input type="email" value="' . $email . '" class="form-control" name="email" required="required"
                                           onchange="email_validate(this.value);">                      
';
                            } else {
                                echo 'olá';
                                echo "Error:" . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                        } else {
                            echo 'hi';
                            echo "Error:" . mysqli_stmt_error($stmt);
                        }
                    } else {
                        echo 'hello';
                        echo "Error:" . mysqli_error($link);
                        mysqli_close($link);
                    }

                }

                if ($perfil == 3) {
                    $id = $_SESSION['iduser'];

                    $link = new_db_connection();

                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT nome, apelido, username, email, nome_estab, estabelecimentos.morada, hora_abertura, hora_fecho FROM utilizadores 
  INNER JOIN estabelecimentos ON idUtilizadores = Utilizadores_idUtilizadores
  WHERE idUtilizadores = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $id);

                        if (mysqli_stmt_execute($stmt)) {

                            mysqli_stmt_bind_result($stmt, $nome, $apelido, $username, $email, $nome_estab, $adress, $hora_abertura, $hora_fecho);

                            if (mysqli_stmt_fetch($stmt)) {
                                echo '
<h3 class="font-weight-bold mt-5">Nome</h3>
<input type="text" name="name" class="form-control mb-0" value="' . $nome . '" >

<h3 class="font-weight-bold mt-5">Apelido</h3>
<input type="text" value="' . $apelido . '" name="apelido" class="form-control mb-0">

<h3 class="font-weight-bold mt-5">Username</h3>
<input type="text" value="' . $username . '" name="username" class="form-control mb-0">
                      
<h3 class="font-weight-bold mt-5">Email</h3>
                                <div class="col-xs-8">
                                    <input type="email" value="' . $email . '" class="form-control" name="email" required="required"
                                           onchange="email_validate(this.value);">
                      <h3 class="font-weight-bold mt-5">Estabelecimento</h3>
    <input type="text" value="' . $nome_estab . '" name="nome_estab" class="form-control mb-0">

    <h3 class="font-weight-bold mt-5">Morada</h3>
    <input type="text" value="' . $adress . '" name="morada" class="form-control mb-0">

    <h3 class="font-weight-bold mt-5">Hora de Abertura</h3>
    <input type="time" value="' . $hora_abertura . '" name="hora_abertura" class="form-control mb-0">

    <h3 class="font-weight-bold mt-5">Hora de Fecho</h3>
    <input type="time" value="' . $hora_fecho . '" name="hora_fecho" class="form-control mb-0">';
                            } else {
                                echo "Error:" . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);


                        } else {
                            echo 'hi';
                            echo "Error:" . mysqli_stmt_error($stmt);
                        }
                    }
                }
            } else {
                header("Location: ../login_registo.php");
            }

            ?>
            <h3 class="font-weight-bold mt-5">Password</h3>
            <input id="password" type="password" class="form-control" name="password"
                   required="required" onkeyup="checkPass(); return false;">

            <h3 class="font-weight-bold mt-5">Confirmar Password</h3>

            <input id="password_confirm" type="password" class="form-control"
                   name="password_confirm"
                   required="required" onkeyup="checkPass(); return false;">
            <span id="confirmMessage" class="confirmMessage"></span>
            <div class="text-center mt-4">
                <button class="btn btn-info text-white" type="submit">Alterar</button>
            </div>
        </form>
        <br><br><br><br><br><br>
</section>