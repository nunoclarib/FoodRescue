
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>

</head>
<body onload="pageScroll()">

<?php include_once 'components/cp_header.php'; ?>

<?php
if (isset($_GET['link'])) {
    $link = $_GET['link'];

    $iduser = $_SESSION['iduser'];

//idnot em string
    $linkid = strval($link);

//idnot em int
    $idnot = intval($link);

    if ($link == $linkid) {

        require_once "connections/connection.php";

        $estado = 0;

        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE notificacoes
              SET estado = ?
              WHERE idNotificacoes = $idnot";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $estado);

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error:" . mysqli_error($link);
            mysqli_close($link);
        }

    }
}
?>
<?php
require_once('connections/connection_chat.php');

if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];
    $_SESSION['idchat'] = $id_destino;
}
?>

<div id="chat" style="margin-bottom: 50px">
    <div class="text-center">
        <i class="far fa-comments fa-3x text-center" style="margin-top: 60%;color: #027381;"></i>
    </div>
    <br>
    <p class="text-center" style="color: #027381;; font-size: 1.4rem;">Começa a conversar!</p>
</div>

<div class="col-12" style="position: fixed; top: 540px; background-color: #027381; border-radius: 10px">

    <form method="post" action="scripts/sc_chat.php" class="text-center mt-2 mb-1">
        <input type="text" name="mensagem" placeholder="Escreva uma mensagem..." class="col-9 form-control">
        <button class="btn btn-info text-white ml-1" type="submit">
            <i class="fas fa-paper-plane"></i></button>
    </form>

</div>

<br>
<br><br><br>

<?php include_once 'components/cp_nav.php'; ?>

<?php include_once 'helpers/js.php'; ?>

</body>
<script src="js/scrolldown.js" language="JavaScript" type="text/javascript"></script>
<script src="js/chat.js"></script>

</html>