<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<body>

<?php include_once 'components/cp_header.php';?>

<?php include_once 'components/cp_perfil.php';?>

<?php include_once 'components/cp_botao.php'?>

<?php include_once 'components/cp_nav.php';?>

<?php include_once 'helpers/js.php';?>

<script>
    function loadDoc() {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("countnotif").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "count_notif.php", true);
            xhttp.send();

    }
    window.onload = function(){
        setInterval(function(){loadDoc();}, 1000);
    };


</script>

</body>

</html>