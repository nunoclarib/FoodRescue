<?php
session_start();

include("connections/connection_chat.php");

if (isset($_SESSION['iduser']) && isset($_SESSION['idchat'])) {

    $iduser = $_SESSION['iduser'];
    $id_destino = $_SESSION['idchat'];

    $sql = $pdo->prepare("SELECT mensagem, nome, idUtilizadores, chat.date_creation FROM chat INNER JOIN utilizadores ON utilizadores_idUtilizadores = idUtilizadores
                                  WHERE (utilizadores_idUtilizadores = ? AND id_destino = '$id_destino')
                                  OR (utilizadores_idUtilizadores = '$id_destino' AND id_destino = ? )
                                  ORDER BY id_msg");

    $sql->execute([$iduser, $iduser]);

   foreach ($sql->fetchAll() as $key)  {

       if ($key['mensagem']!=''){

           if ($key['idUtilizadores'] == $iduser) {
               echo "<h5 class='text-right pr-4 text-info'> " . $key['nome'] . "</h5>";
               echo '<div class="mb-3">
<div class="chat darker text-left mr-2 text-right" style="width: 40%; margin-left: 205px ">
    <p class="mb-0 pr-3">' . $key['mensagem'] . '</p>
</div>
<p class="time-right mr-4" style=" margin-right: 15px; color: darkgrey; font-size: 11px;">' . $key['date_creation'] . '</p>
<br></div>

';
           } else {
               echo "<h5 class='pl-3 text-info'> " . $key['nome'] . "</h5>";
               echo '<div class="mb-3">
    <div class="chat mt-0 ml-3" style="width: 40%;">
        <p class="mb-0 pl-2">' . $key['mensagem'] . '</p>
    </div>
    <p class="time-left mb-0" style=" margin-left: 17px; color: darkgrey; font-size: 11px;">' . $key['date_creation'] . '</p><br>
</div>';
           }
       }
    }
}


?>
