<?php

session_start();

require_once("connections/connection.php");

$iduser = $_SESSION['iduser'];

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "SELECT idNotificacoes, titulo_not, texto_notif, data_notif, estado, direction FROM notificacoes
              WHERE Utilizadores_idUtilizadores = ? ORDER BY idNotificacoes DESC";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $iduser);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_bind_result($stmt, $idnot, $titulo, $texto, $data, $estado, $go);
        while (mysqli_stmt_fetch($stmt)) {
                if ($estado == 0) {
                    echo '<a href="' . $go . '?link='.$idnot.'">
<div class="row">
                <div class="col-4 pt-3 pr-0" >
                    <img class=" arredondamento img-fluid img_notifi" src="img/img_avatar5.png">
                </div>
                <div class="col-8 pl-0">
                    <h5 class="subtitulo_feito font-weight-bold" style="color: #0c5460">' . $titulo . '</h5>
                    <p>' . $texto . '</p>
                    <p>' . $data . '</p>
                </div>
            </div>
            <div class="modal" id="modal" tabindex="-1">
                <a href="#" class="modal__overlay" aria-label="Fechar"></a>
                <div class="modal__content ">
                    <div class=" pb-3 pt-5 mb-2">
                        <div class="centro">
                            <h1 class="text-center text-dark"><b>Entrega de Excedentes Confirmada!</b></h1>
                        </div>
                        <p class="text-center">Os seus excedentes foram entregues!</p>
                    </div>
                    <div class="centro mb-3">
                        <img class="subtitulo" src="img/checkmark-ok.gif" height="50" width="50"/></div>
                    <div class="centro p-2 pb-2 mb-3 corbtn botaopop">
                        <a href="mapa_fornecedor_entregue.html" class="modal__close text-white p-2">
                            <b>Ok</b>
                        </a>
                    </div>
                </div>
            </div>
            </div></a> 
        <hr class="p-0 m-0">';
                } else {
                    echo '<a href="' . $go . '?link='.$idnot.'">
<div class="row fundonoti">
                <div class="col-4 pt-3 pr-0" >
                    <img class=" arredondamento img-fluid img_notifi" src="img/img_avatar5.png">
                </div>
                <div class="col-8 pl-0">
                    <h5 class="subtitulo_feito font-weight-bold" style="color: #0c5460">' . $titulo . '</h5>
                    <p>' . $texto . '</p>
                    <p>' . $data . '</p>
                </div>
            </div>
            <div class="modal" id="modal" tabindex="-1">
                <a href="#" class="modal__overlay" aria-label="Fechar"></a>
                <div class="modal__content ">
                    <div class=" pb-3 pt-5 mb-2">
                        <div class="centro">
                            <h1 class="text-center text-dark"><b>Entrega de Excedentes Confirmada!</b></h1>
                        </div>
                        <p class="text-center">Os seus excedentes foram entregues!</p>
                    </div>
                    <div class="centro mb-3">
                        <img class="subtitulo" src="img/checkmark-ok.gif" height="50" width="50"/></div>
                    <div class="centro p-2 pb-2 mb-3 corbtn botaopop">
                        <a href="mapa_fornecedor_entregue.html" class="modal__close text-white p-2">
                            <b>Ok</b>
                        </a>
                    </div>
                </div>
            </div>
            </div></a>
        <hr class="p-0 m-0">';
                }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error:" . mysqli_stmt_error($stmt);
    }

} else {
    echo "Error:" . mysqli_error($link);
    mysqli_close($link);
}

