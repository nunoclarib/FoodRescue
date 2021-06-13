<!DOCTYPE html>
<html>
<head>
    <?php include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>


</head>
<body id="page-top">

<?php include_once 'components/cp_header.php'; ?>

<section>
    <br>
        <h3 class="text-center" style="color: #027381">Histórico de Recolhas</h3>
</section>

<section class="container-fluid pt-3 ">
        <?php
        require_once "connections/connection.php";
        if(isset($_SESSION['iduser'])){
            $iduser=$_SESSION['iduser'];
            $link=new_db_connection();
            $stmt= mysqli_stmt_init($link); // create a prepared statement
            $query="SELECT excedente,data_hora, Estabelecimentos_idEstabelecimentos, status_recolha,status_confirmacao , nome_estab FROM excedentes 
                    INNER JOIN estabelecimentos ON excedentes.Estabelecimentos_idEstabelecimentos=estabelecimentos.idEstabelecimentos 
                    WHERE excedentes.utilizadores_idUtilizadores=?  ORDER BY idExcedentes desc ";
        if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $iduser);
        if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $excedente, $datahora, $id_estabelecimento, $status_recolha, $status_confirmacao, $nome_estab);
        while (mysqli_stmt_fetch($stmt)) {
           if($status_recolha==0 && $status_confirmacao==0){
               $fundo='fundonoti';
               $recolha='Por Recolher';
               $colunas='col-6';
               $img="img/mercearia_cinzento.png";
               $cortitulo="subtitulo";
           }else if($status_recolha==1 && $status_confirmacao==0){
               $fundo="fundonoti";
               $recolha="Recolhido e Por Entregar";
               $colunas='col-9';
               $img="img/mercearia_cinzento.png";
               $cortitulo="subtitulo";
           }else{
               $fundo="";
               $recolha="Recolhido e Entregue";
               $colunas='col-8';
               $img="img/mercearia_cinzento.png";
               $cortitulo="";
           };

           ?>
        <div class="row <?=$fundo?>">
        <div class="col-3 pt-3 pr-0 ">
            <img class=" img-fluid img_notifi" src="<?=$img?>">
        </div>
        <div class=" <?=$colunas?> pl-0 pr-0">
            <h5 class="<?=$cortitulo?>"> Status: <?=$recolha?></h5>
            <p class="mb-0"><?=$nome_estab?></p>
            <p style="font-size: 12px; color: grey" class="p-0"><?=$datahora?></p>
        </div>
            <?php if($status_recolha==0){?>
        <div class="col-2 pr-0 pl-4 mt-3" align="center">
            <a href="#modal"><i class="fas fa-times cancelar fa-3x text-danger"> </i></a>
        </div><?php
            }?>
        </div>
            <hr class="p-0 m-0">
            <?php
        }
        if ($excedente==NULL){
                echo '<div class="text-center" style="color: #027381; margin-top: 40%;">
                    <i class="fas fa-handshake-slash fa-3x"></i>
                    </div>
                    <br>
                    <p class="text-center" style="color: #027381; font-size: 1.4rem;">Ainda não realizaste nenhuma recolha!</p></div>';
            }
         }?>


            <div class="modal" id="modal" tabindex="-1">
                <a href="#" class="modal__overlay" aria-label="Fechar"></a>
                <div class="modal__content ">
                    <div class=" pt-3">
                        <div class="centro">
                            <h1 class="text-center text-dark"><b>Cancelar Recolha?</b></h1>
                        </div>
                        <p class="text-center p-2">Pretende cancelar a recolha dos excedentes?</p>
                        <div class="centro pb-4">
                            <i class="fas fa-exclamation-triangle text-warning fa-2x"></i><br>
                        </div>
                    </div>

                    <div class="centro p-2 mb-3 botaopop verde">
                        <a href="scripts/sc_cancelar_recolha.php" class="modal__close text-white ">
                            <b><i class="fas fa-check"></i> Sim</b>

                        </a>
                    </div>
                    <div class="p-2 mt-2 vermelho centro botaopop">
                        <a href="#" class="modal__close text-white ">
                            <b><i class="fas fa-times"></i> Não</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            mysqli_stmt_close($stmt);
        }
            mysqli_close($link);
        };?>

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
