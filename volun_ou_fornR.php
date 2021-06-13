<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<body style="background: rgb(2,115,129);
    background: linear-gradient(90deg, rgba(2,115,129,1) 26%, rgba(79,182,209,1) 100%);">
<a href="login_registo.php"><img class="seta_recua" src="img/seta_recua.png"></a>
<img class="logo" src="img/logotipo.png">

<p class="p_forn_ou_vol">Escolha o perfil que se adequa a si</p>

<div class="div_btns_forn_vol" align="center">
    <div class="div_btn_fornecedor">
        <img class="img_forn_vol" src="img/fornecedor.png">
        <a href="registo_forn.php">
            <button class=" btn_forn_vol btn_fornecedor" type="button" name="btn_fornecedor" value="perfil_fornecedor">
                Fornecedor
            </button>
        </a>
    </div>

    <div class="div_btn_fornecedor">
        <img class="img_forn_vol" src="img/voluntario.png">
        <a href="registo_volun.php">
            <button class=" btn_forn_vol btn_fornecedor" type="button" name="btn_fornecedor" value="perfil_fornecedor">
                Voluntário
            </button>
        </a>
    </div>

</div>

<!-- Plugin JavaScript -->
<?php include_once 'helpers/js.php';?>

</body>

</html>