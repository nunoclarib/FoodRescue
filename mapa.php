<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>

</head>
<style>

    * {
        margin: 0;
    }

    #map {
        height: 530px;
        width: 100%;
    }

    #floating-panel {
        position: absolute;
        top: 45%;
        left: 15%;
        z-index: 5;
        opacity: 0.8;
        background-color: #027381;
        border-radius: 10px;
        color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        margin-top: 120px;
    }

</style>
<?php

include_once 'components/cp_header.php';

if (!isset($_SESSION['perfil'])) {
    $perfil = $_SESSION['perfil'];
    header("Location: login_registo.php");
} else {
    require_once 'connections/connection.php';
    $perfil = $_SESSION['perfil'];
    $id_user = $_SESSION['iduser'];
}

?>

<body id="page-top">

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

<section class="container-fluid  pt-1 pl-0 pr-0">

    <?php
    if ($perfil == 2 ) {
        ?>
        <div id="floating-panel">
            <select id="start" class="d-none">
                <option id="partida">Chicago</option>
            </select>
            <h6>Estabelecimentos com Excedentes</h6>
            <form id ='botaotrajeto' action="scripts/sc_trajeto.php" method="post" class="mt-0">
            <select id="end" class="form-control" name='estab' >
                <option value="0" disabled>Escolhe um estabelecimento:</option>
                <?php

                $status_recolha = 0;

                $link3 = new_db_connection(); // Create a new DB connection

                $stmt3 = mysqli_stmt_init($link3); // create a prepared statement

                $query3 = "Select Estabelecimentos_idEstabelecimentos, estabelecimentos.nome_estab, latitude, longitude, 
                            estabelecimentos.Utilizadores_idUtilizadores 
                           FROM excedentes INNER JOIN estabelecimentos 
                           ON excedentes.Estabelecimentos_idEstabelecimentos=estabelecimentos.idEstabelecimentos 
                           WHERE status_recolha=?"; // Define the query

                if (mysqli_stmt_prepare($stmt3, $query3)) { // Prepare the statement

                    mysqli_stmt_bind_param($stmt3, 'i', $status_recolha);

                    mysqli_stmt_execute($stmt3); // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt3, $id_estab, $nome_estab, $latitude, $longitude, $fornecedor);

                    while (mysqli_stmt_fetch($stmt3)) { ?>
                        <option value="<?= $latitude ?>,<?= $longitude ?>"><?= $nome_estab ?></option>
                        <?php
                    }
                    mysqli_stmt_close($stmt3); // Close statement
                    mysqli_close($link3);

                } else {
                    echo("Error description: " . mysqli_error($link3));
                }

                ?>
            </select>

                <button type="submit" class="btn btn-info"> Começar </button>
            </form>

        </div>
        <?php
    }
    ?>

    <div id="map"></div>

    <?php include_once 'components/cp_botao.php' ?>

</section>


<?php include_once 'components/cp_nav.php'; ?>

<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php'; ?>

<script>

    function loadDoc() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("countnotif").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "count_notif.php", true);
        xhttp.send();

    }

    window.onload = function () {
        setInterval(function () {
            loadDoc();
        }, 1000);
    };

    var map, infoWindow;

    <?php

    if ($perfil == 3){

    $link = new_db_connection(); // Create a new DB connection

    $stmt = mysqli_stmt_init($link); // create a prepared statement

    $query = "SELECT nome_estab, latitude, longitude FROM estabelecimentos WHERE Utilizadores_idUtilizadores = ?"; // Define the query

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, 'i', $id_user);

        mysqli_stmt_execute($stmt); // Execute the prepared statement

        mysqli_stmt_bind_result($stmt, $nome_estab, $latitude, $longitude);

        if (!mysqli_stmt_fetch($stmt)) {

            echo("Error description: " . mysqli_error($link));
        } else {
            mysqli_stmt_close($stmt); // Close statement
            mysqli_close($link);
        }


    } else {
        echo("Error description: " . mysqli_error($link));
    }

    $lat = floatval($latitude);
    $lng = floatval($longitude);


    ?>

    function initMap() {


        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?=$lat?>, lng: <?=$lng?>},
            zoom: 17
        });


        var contentString = '<h5><?= $nome_estab?></h5>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        var marker = new google.maps.Marker({
            position: {lat:  <?=$lat?>, lng: <?=$lng?>},
            map: map,
            title: 'Hello World!'
        });

        // To add the marker to the map, call setMap();


        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });


        marker.setMap(map);
    }

    <?php
    }

    ?>

    <?php

    if ($perfil == 2){

    $i = 0;
    ?>

    function initMap() {

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.6412, lng: -8.65362},
            zoom: 17
        });


        var contentString = '<h5><?=$_SESSION['username'];?></h5>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        var marker = new google.maps.Marker({
            map: map,
            title: 'Hello World!'
        });

        // To add the marker to the map, call setMap();


        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });

        marker.setMap(map);

        <?php
        $link2 = new_db_connection(); // Create a new DB connection

        $stmt2 = mysqli_stmt_init($link2); // create a prepared statement

        $query2 = "SELECT nome_estab, latitude, longitude FROM estabelecimentos"; // Define the query

        if (mysqli_stmt_prepare($stmt2, $query2)) { // Prepare the statement


        mysqli_stmt_execute($stmt2); // Execute the prepared statement

        mysqli_stmt_bind_result($stmt2, $nome_estab, $latitude, $longitude);

        while (mysqli_stmt_fetch($stmt2)) {
        $i++;

        //inserir todos os estabelecimentos com latitude e longitude
        ?>

        var contentString<?=$i?> = '<h5><?=$nome_estab?></h5>';

        var infowindow<?=$i?>  = new google.maps.InfoWindow({
            content: contentString<?=$i?>
        });


        var marker<?=$i?> = new google.maps.Marker({
            position: {lat:  <?=$latitude?>, lng: <?=$longitude?>},
            map: map,
            title: 'Hello World!'
        });

        // To add the marker to the map, call setMap();


        marker<?=$i?>.addListener('click', function () {
            infowindow<?=$i?>.open(map, marker<?=$i?> );
        });


        marker<?=$i?>.setMap(map);

        <?php

        }



        mysqli_stmt_close($stmt2); // Close statement
        mysqli_close($link2);


        } else {
        echo("Error description: " . mysqli_error($link2));
    }

        ?>


        // HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                var lati = position.coords.latitude;
                var long = position.coords.longitude;

                document.getElementById('partida').value = lati + ',' + long;


                marker.setPosition(pos);
                map.setCenter(pos);
                // To add the marker to the map, call setMap();
                marker.setMap(map);


            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });

        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        directionsRenderer.setMap(map);

        var onChangeHandler = function () {
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService.route(
            {
                origin: {query: document.getElementById('start').value},
                destination: {query: document.getElementById('end').value},
                travelMode: 'DRIVING'
            },
            function (response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    <?php
    }
    ?>
</script>
<script async defer
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCYbTjq44AzwReF-3FCBeOyNXIA0T94J9Y&callback=initMap">
</script>

</body>

</html>