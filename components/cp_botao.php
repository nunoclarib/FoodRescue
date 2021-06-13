<?php
$perfil = $_SESSION['perfil'];

if ($perfil == 3) {

    ?>
    <a href="comunicar_excedentes.php">
        <div class="text-center divbuttonplus">
            <img src="img/plusbutton.png" id="plusbutton" class="mx-auto align-content-center" height="50"
                 width="50">
        </div>
    </a>
    <?php
}
if ($perfil == 2){
    // Mudar direção, fazer página !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    ?>
    <a href="historico_recolhas.php">
        <div  class="text-center divbuttonplus">
            <img src="img/iconrecolhasbicla.png" id="plusbutton" class="mx-auto align-content-center" height="50" width="50">
        </div>
    </a>
    <?php
}

?>