<!DOCTYPE html>
<html>
<head>
    <?php include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>


</head>
<body id="page-top">

<?php include_once 'components/cp_header.php'; ?>
<div class="text-center titulochat ">
</div>
<section class="container-fluid pt-3 ">
    <?php
    require_once 'connections/connection.php';


    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT nome, idUtilizadores, foto_pessoal FROM utilizadores ";

    if (mysqli_stmt_prepare($stmt, $query)) {

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $nome, $id, $foto);

            while (mysqli_stmt_fetch($stmt)) {
                echo '<a href="index_chat.php?id=' . $id . '">
        <hr class="p-0 m-0" style="color: dimgray">
        <div class="row">
            <div class="col-3 pt-3 pr-2 pb-3">';
                if ($foto != NULL) {
                    echo '<img class=" img-fluid img_chat" src="uploads/' . $foto . '">';
                } else {
                    echo '<img class=" img-fluid img_chat" src="img/img_avatar5.png">';
                }
                echo '</div>
            <div class="col-7 pl-0 pl-2">
                <h5>' . $nome . '</h5>
                <p class="mb-0 text-info">Clica para conversar</p>
                <p class="datachat"></p>
                </div>
        </div>
    </a>';

            }

            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }

    ?>
    <br><br><br>
</section>

<?php include_once 'components/cp_botao.php' ?>

<?php include_once 'components/cp_nav.php'; ?>

<?php include_once 'helpers/js.php'; ?>

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