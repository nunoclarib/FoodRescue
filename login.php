<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<body style="background: rgb(2,115,129);
    background: linear-gradient(90deg, rgba(2,115,129,1) 26%, rgba(79,182,209,1) 100%);">
<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "Ocorreu um erro no registo, tente um novo username ou email.";
            $class = "alert-warning";
            $login = false;
            break;
        case 1:
            $message = "Ocorreu um erro no login, a palavra passe ou o username estão errados.";
            $class = "alert-warning";
            $login = false;
            break;
        case 2:
            $message = "Campos por preencher!";
            $class = "alert-danger";
            $login = false;
            break;
        case 3:
            $message = "Password errada";
            $class = "alert-warning";
            $login = false;
            break;
        case 4:
            $message = "Username não existe";
            $class = "alert-warning";
            $login = false;
            break;


        default:
            $msg_show = false;
    }
}
?>
<a href="login_registo.php"><img class="seta_recua" src="img/seta_recua.png"></a>
<img class="logo" src="img/logotipo.png">
<div id="login">
<form action="scripts/sc_login.php" method="post">
    <div class="imgcontainer">
        <img src="img/img_avatar4.png" alt="Avatar" class="avatar">
    </div>

    <div class="login_container">
        <?php
        if (isset($_GET["msg"]) && $login == false) {
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
        <label class="label_login"><b>Nome de Utilizador</b></label>
        <input type="text" placeholder="Nome de Utilizador" name="username" class="form-control">

        <label class="label_login"><b>Password</b></label>
        <input class="label_login_pass form-control" type="password" placeholder="Password" name="password" >

        <button class="btn_login mt-5 p-3" type="submit">Login</button>
    </div>



</form>
</div>
<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php';?>

</body>

</html>