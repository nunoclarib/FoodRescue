<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'helpers/meta.php'; ?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php'; ?>

    <style>
        body {
            font-family: Roboto, sans-serif;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: lightseagreen;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>

</head>
<body>

<?php include_once 'components/cp_header.php'; ?>
<div class="tab text-center row mt-1">
    <button class="tablinks col-6 text-center" onclick="openCity(event, 'Declarar')" id="defaultOpen">Declarar
        Excedentes
    </button>
    <button class="tablinks col-6 text-center" onclick="openCity(event, 'Ver')">Histórico</button>
</div>
<div id="Declarar" class="tabcontent">

    <section class="container-fluid fundopagina imagemfundo mt-2">
        <form method="post" action="scripts/sc_comunicar_excedentes.php" class="mt-0">
            <label class="text-center mt-3" for="name"><h4 class="subtitulo mt-1 mb-0">Tipo de
                    Excedente:</h4></label><br>
            <input type="text" placeholder="Tipo de Excedente" id="alimento" name="alimento" class="form-control mb-0">
            <div>
                <label class="mt-3" for="quantidade"><h4 class="subtitulo">Quantidade:</h4></label>
                <input type="number" placeholder="Quantidade" id="quantidade" name="quantidade" class="form-control"
                       value="0" min="0" max="1999">
                <label class="mt-3" for="grandeza"><h4 class="subtitulo">Grandeza:</h4></label>
                <select class="form-control" placeholder="Grandeza" id="grandeza" name="grandeza">
                    <option value="" disabled selected>Grandeza</option>
                    <?php
                    require_once "connections/connection.php";
                    session_start();
                    if (isset($_SESSION['iduser'])){
                    $iduser = $_SESSION['iduser'];
                    $link = new_db_connection(); // Create a new DB connection
                    $stmt = mysqli_stmt_init($link); // create a prepared statement
                    $query = "SELECT idGrandezas, grandeza from grandezas ";
                    if (mysqli_stmt_prepare($stmt, $query)) {
                    if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_bind_result($stmt, $id_gr, $grandeza);
                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                        <option value="<?= $id_gr ?>"><?= $grandeza ?></option>
                        <?php
                    };
                    ?>
                </select>
            </div>


            <label class="mt-4" for="msg">
                <h4 class="subtitulo mt-0 ">Observações:</h4>
            </label>

            <div>
                <textarea class="align-items-center contorno form-control" id="msg" name="msg" rows="4"
                          placeholder="Observações..." cols="40"></textarea>
            </div>
            <br>
            <div class="centro mt-2 mb-5">
                <button class="btn text-center p-2 col-6" style="background-color: lightseagreen"><a href="#modal"
                                                                                                     class="text-white">Submeter</a>
                </button>
                <div class="modal" id="modal" tabindex="-1">
                    <div class="modal__content ">
                        <div class="pt-3">
                            <div class="centro">
                                <h1 class="text-center text-dark"><b>Confirmar Excedentes?</b></h1>
                            </div>
                            <p class="text-center p-2">Pretende confirmar a recolha dos excendentes?</p>
                        </div>
                        <div class="centro pb-4">
                            <i class="fas fa-exclamation-triangle text-warning fa-2x"></i><br>
                        </div>
                        <div>
                            <button type="submit"
                                    class="centro p-2 mb-3 col-12 btn btn-success btn-outline-success text-white">
                                <b><i class="fas fa-check"></i> Sim</b>
                            </button>
                        </div>
                        <div>
                            <a href="#">
                                <button type="button"
                                        class="p-2 mt-2 btn btn-danger btn-outline-danger text-white centro col-12">
                                    <b><i class="fas fa-times"></i> Não</b>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            mysqli_stmt_close($stmt);
            }
            ?>

        </form>

    </section>
</div>

<div id="Ver" class="tabcontent">
    <section class="container-fluid pt-3">
        <?php
        $stmt2 = mysqli_stmt_init($link); // create a prepared statement
        $query2 = "SELECT excedente,quantidade, data_hora, nota, estabelecimentos.nome_estab from excedentes INNER JOIN estabelecimentos 
                    ON idEstabelecimentos = Estabelecimentos_idEstabelecimentos WHERE estabelecimentos.Utilizadores_idUtilizadores = ?";

        if (mysqli_stmt_prepare($stmt2, $query2)) {
            mysqli_stmt_bind_param($stmt2, "i", $iduser);
            if (mysqli_stmt_execute($stmt2)) {
                mysqli_stmt_bind_result($stmt2, $excedentes, $quantidade, $datahora, $nota, $estabelecimento);

                while (mysqli_stmt_fetch($stmt2)) {

                        echo '<div class="row">
                        <div class="col-3 pt-3 pr-0">
                            <img class="img-fluid img_notifi" src="img/leve-embora_feito.png">
                        </div>
                        <div class="col-7 pl-0">
                            <h5 class="subtitulo">' . $excedentes . '</h5>
                            <p>Quantidade:' . $quantidade . '</p>
                            <p>Data:' . $datahora . '</p>
                            <p>Estabelecimento: ' . $estabelecimento . '</p>
                        </div>
                    </div>
                    <hr class="p-0 m-0">';
                }
                if ($excedentes==NULL) {
                    echo '<div class="text-center" style="color: #027381; margin-top: 45%;">
                    <i class="fas fa-utensils fa-3x"></i>
                    </div>
                    <br>
                    <p class="text-center" style="color: #027381; font-size: 1.4rem;">Nenhum excedente declarado...</p></div>';
                }


            }
            mysqli_stmt_close($stmt2);
        }
        mysqli_close($link);
        }; ?>
</div>
</section>

</div>


<?php include_once 'components/cp_botao.php' ?>
<?php include_once 'components/cp_nav.php'; ?>

<br>
<br>
<br>


<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Custom scripts for this template -->
<script src="js/stylish-portfolio.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

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

    document.getElementById("defaultOpen").click();
</script>

</body>
</html>







