<section class="container-fluid">

    <br><br><br><br>
    <?php
    require_once "connections/connection.php"; // We need the function!

    $perfil = $_SESSION['perfil'];
    $id_user = $_SESSION['iduser'];

    if ($perfil == 2) {

        $link = new_db_connection(); // Create a new DB connection

        $stmt2 = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT foto_pessoal FROM utilizadores
                  WHERE idUtilizadores = ?"; // Define the query

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
    </div>
    <?php
    require_once 'connections/connection.php';

    $perfil = $_SESSION['perfil'];
    $iduser = $_SESSION['iduser'];

    if (isset($iduser) && isset($perfil)) {

        if ($perfil == 2) {
            $id = $_SESSION['iduser'];

            $link = new_db_connection();

            $stmt = mysqli_stmt_init($link);

            $query = "SELECT nome, apelido, username, email, nome_organizacao FROM utilizadores 
INNER JOIN organizacoes ON idOrganizacoes = Organizacoes_idOrganizacoes
WHERE idUtilizadores = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'i', $id);

                if (mysqli_stmt_execute($stmt)) {

                    mysqli_stmt_bind_result($stmt, $nome, $apelido, $username, $email, $org);


                    if (mysqli_stmt_fetch($stmt)) {
                        echo '<br><br><br><br><br><br><br><br><br><br>

    <h3 class="font-weight-bold mt-5">Nome</h3>
    <h4 class="mt-2">' . $nome . '</h4>
    
    <h3 class="font-weight-bold mt-5">Apelido</h3>
    <h4 class="mt-2">' . $apelido . '</h4>

    <h3 class="font-weight-bold mt-5">Username</h3>
    <h4 class="mt-2">' . $username . '</h4>

    <h3 class="font-weight-bold mt-5">Email</h3>
    <h4 class="mt-2">' . $email . '</h4>
    <h3 class="font-weight-bold mt-5">Organização</h3>
    <h4 class="mt-2">' . $org . '</h4>';


                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                } else {
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
                        echo '<br><br><br><br><br><br><br><br><br><br>

    <h3 class="font-weight-bold mt-5">Nome</h3>
    <h4 class="mt-2">' . $nome . '</h4>
    
    <h3 class="font-weight-bold mt-5">Apelido</h3>
    <h4 class="mt-2">' . $apelido . '</h4>

    <h3 class="font-weight-bold mt-5">Username</h3>
    <h4 class="mt-2">' . $username . '</h4>

    <h3 class="font-weight-bold mt-5">Email</h3>
    <h4 class="mt-2">' . $email . '</h4>
    <h3 class="font-weight-bold mt-5">Estabelecimento</h3>
    <h4 class="mt-2">' . $nome_estab . '</h4>

    <h3 class="font-weight-bold mt-5">Morada</h3>
    <h4 class="mt-2">' . $adress . '</h4>

    <h3 class="font-weight-bold mt-5">Hora de Abertura</h3>
    <h4 class="mt-2 ">' . $hora_abertura . '</h4>

    <h3 class="font-weight-bold mt-5">Hora de Fecho</h3>
    <h4 class="mt-2 ">' . $hora_fecho . '</h4>';

                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);


                } else {
                    echo "Error:" . mysqli_stmt_error($stmt);
                }
            }
        }
    } else {
        header("Location: ../login_registo.php");
    }
    ?>


    <div class="text-center mt-4">
        <a href="editarperfil.php">
            <button class="btn btn-info text-white">Editar Perfil</button>
        </a>
        <a href="editarpassword.php">
            <button class="btn btn-info text-white">Editar Password</button>
        </a>
    </div>


    <br><br><br><br><br>

</section>