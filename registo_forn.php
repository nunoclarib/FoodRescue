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

        default:
            $msg_show = false;
    }
}
?>
<a href="volun_ou_fornR.php"><img class="seta_recua" src="img/seta_recua.png"></a>
<img class="logo" src="img/logotipo.png">

<form action="scripts/sc_registo_forn.php" method="post">
    <div class="imgcontainer">
        <img src="img/profile_pic_2.png" alt="Foto de Perfil" class="foto_registo">
    </div>

    <div class="login_container" id="registo">
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
        <label class="label_login"><b>Nome</b></label>
        <input type="text" placeholder="Nome" name="nome" class="form-control">

        <label class="label_login"><b>Apelido</b></label>
        <input type="text" placeholder="Apelido" name="apelido" class="form-control">

        <label class="label_login"><b>Email</b></label>
        <input type="email" placeholder="example@something.com" required="required" onchange="email_validate(this.value)" name="mail" class="form-control">

        <label class="label_login"><b>Contacto</b></label>
        <input type="text" placeholder="Contacto" name="contacto" class="form-control">

        <label class="label_login mt-4"><b>Nome de Utilizador</b></label>
        <input type="text" placeholder="Nome de Utilizador" name="username" class="form-control">

        <label class=" label_login"><b>Password</b></label>
        <input id ='password' class="label_pass_registo form-control" type="password" placeholder="Password" name="password" required="required" onkeyup="checkPass(); return false;">
        <div class="mb-3">
        <label class=" label_login"><b>Confirmar Password</b></label>
        <input id="password_confirm" type="password" class="form-control" placeholder="Confirmar password"
               name="password_confirm"
               required="required" onkeyup="checkPass(); return false;">
        <span id="confirmMessage" class="confirmMessage"></span>
        </div>
        <div class="container">
            <input type="checkbox" id="termos_conds" name="termos_conds" value="termos_conds" >
            <label class="label_login"> Li e aceito os <a href="#" class="link_terms_conds">termos & condições</a>.</label><br>
        </div>
        <button class="btn_login" type="submit">Registar</button>
    </div>


</form>

<script>
    // validate email
    function email_validate(email) {
        var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

        if (regMail.test(email) == false) {
            document.getElementById("status").innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
        } else {
            document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
        }
    }

    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = $("#password");
        var pass2 = $("#password_confirm");

        console.log(pass1.value, pass2);
        //Store the Confimation Message Object ...
        var message = $('#confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if (pass1.val() == pass2.val()) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            pass2.css("backgroundColor", goodColor);
            message.css("color", goodColor);
            message.html("Passwords Match");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            message.css("color", badColor);
            message.html("Passwords Do Not Match!");
        }
    }

</script>

<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php';?>

</body>

</html>