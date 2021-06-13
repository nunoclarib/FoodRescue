<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<style>

    #map{
        height: 530px;
        width: 100%;
    }
</style>

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
<img class="logo" src="img/logotipo.png">

<form action="scripts/sc_registo_fornE.php" method="post">
    <div class="imgcontainer">
        <img src="img/restaurante.png" alt="Foto de Perfil" class="foto_registo">
    </div>

    <div class="login_container" id="estabelecimento">
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
        <label class="label_login"><b>Estabelecimento</b></label>
        <input type="text" placeholder="Nome do Estabelecimento" name="nome_estabelecimento" class="form-control">

        <label class="label_login"><b>Morada</b></label>
        <input type="text" placeholder="Morada do Estabelecimento" name="morada_estabelecimento" class="form-control">

        <label class="label_login"><b>Descrição</b></label>
        <input type="text" placeholder="Breve descrição do estabelecimento" name="descricao_estabelecimento" class="form-control">

        <label class="label_login"><b>Hora de Abertura</b></label>
        <input type="text" placeholder="HH : MM" name="hora_abertura" class="form-control">

        <label class="label_login"><b>Hora de Fecho</b></label>
        <input type="text" placeholder="HH : MM" name="hora_fecho" class="form-control">


        <label class="label_login"><b>Localização</b></label>
        <div id="map"></div>
        <input type="hidden" id="latlngMap" name="Coordenadas" class="form-control">
        <div class="text-center">
            <button class="btn btn-light mt-2 mb-4"  type="button" data-toggle="modal" data-target="#myModal">Adicionar Localização</button>
        </div>

        <a href="mapa_fornecedor.php"><button class="btn_login" type="submit">Registar</button></a>
    </div>


</form>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center">Localização do Estabelecimento</h2>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <label class="text-left">Insere uma morada:</label>
                    <input id="address" type="text" placeholder="Localização" value="Aveiro">
                    <input id="submit" type="button" data-dismiss="modal" value="Adicionar" class="btn btn-info" >
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php';?>

<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: 40.6412, lng: -8.65362}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });


    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });

                document.getElementById('latlngMap').value = results[0].geometry.location;
                //console.log(results[0].geometry.location);

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });

    }



</script>

<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCYbTjq44AzwReF-3FCBeOyNXIA0T94J9Y&callback=initMap">

</script>

</body>

</html>