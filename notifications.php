<!DOCTYPE html>
<html>
<head>
    <?php include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>


</head>
<body id="page-top">

<nav class="navbar navbar-light fixed-top " id="TopNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger  text-white " href="#"><img src="img/logo_foodrescue.png"
                                                                             alt="logo food rescue"></a>
        <?php
        session_start();
        $paginaLink = basename($_SERVER['SCRIPT_NAME']);

        if ($paginaLink == 'notifications.php') {
            echo '<a href="notifications.php"><i class="fas fa-bell fa-2x icons" style="color: #027381;" aria-label="Icon notificações"></i></a>';
        } else {
            echo '<a href="notifications.php"><i class="fas fa-bell fa-2x icons" aria-label="Icon notificações"></i>';

            echo '<i class="fas fa-circle fa-1x" style="color: #027381; position: absolute; top: 19px; right: 24px;" aria-label="Icon notificações"></i></a>';
        }
        ?>
    </div>
</nav>
<br><br><br>

<section class="container-fluid pt-2 " id="shownotifs">

</section>
<br><br><br><br>

<?php
include_once 'components/cp_botao.php' ?>

<?php include_once 'components/cp_nav.php'; ?>

<?php include_once 'helpers/js.php'; ?>
<script>
    function loadNotifs(response) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("shownotifs").innerHTML = this.responseText;
                if (this.responseText === ''){
                    document.getElementById("shownotifs").innerHTML += '<div id="no_notif">\n' +
                        '    <div class="text-center" >\n' +
                        '        <i class="far fa-sad-tear fa-3x text-center" style="margin-top: 55%;color: #027381;"></i>\n' +
                        '    </div>\n' +
                        '    <br>\n' +
                        '    <p class="text-center" style="color: #027381; font-size: 1.4rem;">Ainda não tens nenhuma\n' +
                        '        notificação...</p></div>';
                }
            }

        };
        xhttp.open("GET", "mostra_notifs.php", true);
        xhttp.send();

    }


    window.onload = function () {
        setInterval(function () {
            loadNotifs();
        }, 1000);
    };
</script>
</body>

</html>