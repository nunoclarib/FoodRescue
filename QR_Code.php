<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 1:
            $message = "O QRCode não corresponde ao da organização escolhida";
            $class = "alert-warning";
            $qrcode = false;
            break;
        default:
            $msg_show = false;
            $qrcode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Food Rescue</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="img/logo_favicon.png"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="css/fontawesome-free/css/all.css">
    <link href="css/styles_Carol.css" rel="stylesheet"/>
</head>
<body class="body_intro2">

<section class="container-fluid">

    <div class="text-center mt-3 mr-3">
        <img src="img/logotipo.png" class="tamanho_img_inicial">

        <h4 class="cor_camara mt-5  mb-5">Insira o QRCode fornecido pela Organização</h4>


        <div style='position:relative; top:0px; left:0px;'>


            <div style='position:relative; top:30%; left: 5px' class="text-center">
                <!---<a href="qrcode-js-master/qrcodecam.php"><i class="fas fa-camera fa-3x cor_camara"></i></a>-->
                <?php include_once "qrcode-js-master/qrcodecam.php"?>
            </div>
            <?php
            if (isset($_GET["msg"]) && $qrcode == false) {
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
        </div>



    </div>


</section>


</body>
</html>