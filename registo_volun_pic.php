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
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<body style="background: rgb(2,115,129);
    background: linear-gradient(90deg, rgba(2,115,129,1) 26%, rgba(79,182,209,1) 100%);">

<img class="logo" src="img/logotipo.png">

<form method="post" action="upload_fotopessoal_volun.php" enctype="multipart/form-data">

    <div class="imgcontainer">
        <img src="img/profile_pic_2.png" alt="Foto de Perfil" class="foto_registo">
    </div>

    <div class="login_container" id="uploadpessoal">
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
        }

        ?>
        <label class="label_login" style="margin-bottom: 20px"><b>Escolha uma Foto para o seu Perfil:</b></label><br>
        <input type="file" name="fileupload"><br><br>

        <div class="text-center">
            <button type="submit" name="submit" class="btn text-white" style="background-color: lightseagreen">Submeter imagem</button>
        </div>
    </div>
</form>

<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php';?>

</body>

</html>