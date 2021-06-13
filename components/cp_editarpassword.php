<section class="container-fluid">
    <br><br><br><br>
    <?php

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
    </div>

    <br><br><br><br><br><br><br><br><br><br>

    <form method="post" action="scripts/sc_editarpassword.php" >

        <input type="hidden" name="id_users" value="<?= $id_user ?>">

        <h3 class="font-weight-bold mt-5">Password Atual</h3>
        <input id="password" type="password" class="form-control" name="password_atual">

        <h3 class="font-weight-bold mt-5">Password Nova</h3>
        <input id="password_nova" type="password" class="form-control" name="password_nova"
               required="required" onkeyup="checkPass(); return false;">

        <h3 class="font-weight-bold mt-5">Confirmar Password</h3>

        <input id="password_confirm" type="password" class="form-control"
               name="password_confirm"
               required="required" onkeyup="checkPass(); return false;">
        <span id="confirmMessage" class="confirmMessage"></span>

        <div class="text-center mt-4">
            <a href="editarperfil.php">
                <button class="btn btn-info text-white">Alterar</button>
            </a>
        </div>



    </form>


    <br><br><br><br>



</section>