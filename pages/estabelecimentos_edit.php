<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "../components/c_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components/c_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão do Estabelecimento</h1>

                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edição do Estabelecimento
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <?php
                                $erro= false;
                                require_once '../connections/connection.php';
                                if(isset($_GET['id_estab'])) {
                                    $id_estab=$_GET['id_estab'];

                                    $link = new_db_connection(); // Create a new DB connection

                                    $stmt = mysqli_stmt_init($link); // create a prepared statement

                                    $query = "SELECT  nome_estab, morada, descricao, hora_abertura, hora_fecho, fot_estab, latitude, longitude, comprovativo, Utilizadores_idUtilizadores, utilizadores.nome FROM estabelecimentos
                               INNER JOIN utilizadores ON estabelecimentos.Utilizadores_idUtilizadores=utilizadores.idUtilizadores WHERE idEstabelecimentos=?"; // Define the query

                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                                        mysqli_stmt_bind_param($stmt, 'i', $id_estab);
                                        mysqli_stmt_execute($stmt);

                                        mysqli_stmt_bind_result($stmt,  $nome_estab, $morada_estab, $descricao, $hora_ab, $hora_f, $foto_estab, $latitude, $longitude, $comprovativo, $id_users, $nome);


                                        if (!mysqli_stmt_fetch($stmt)) {
                                        $erro = true;
                                        require_once "404.php";
                                        }
                                        else{

                                            ?>

                                            <form role="form" method="post" action="../scripts/sc_estab_update.php">
                                            <input type="hidden" name="id_estab" value="<?= $id_estab ?>">
                                            <div class="form-group">
                                                <label>ID do Estabelecimento</label>
                                                <p class="form-control-static"><?= $id_estab ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Nome do Estabelecimento</label>
                                                <input class="form-control" name="nome"
                                                       value="<?= $nome_estab ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Morada</label>
                                                <input class="form-control" name="morada"
                                                       value="<?= $morada_estab ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input class="form-control" name="descricao" type="text" value="<?= $descricao ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Hora de Abertura</label>
                                                <input class="form-control" name="horaabertura" type="time" value="<?= $hora_ab ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Hora de Fecho</label>
                                                <input class="form-control" name="horafecho" type="time" value="<?= $hora_f ?>">
                                            </div>
                                            <!--
                                            <div class="form-group">
                                                <label>Fotografia</label>
                                                <input class="form-control" name="fotografia" value="<?= $foto_estab ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <input class="form-control" name="latitude" value="<?= $latitude ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <input class="form-control" name="longitude" value="<?= $longitude ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Comprovativo</label>
                                                <input class="form-control" name="comprovativo"
                                                       value="<?= $comprovativo ?>">
                                            </div>
                                            -->
                                            <div class="form-group">
                                            <label>Utilizador</label>
                                            <select name="id_utilizador" class="form-control">
                                            <?php

                                        }
                                        mysqli_stmt_close($stmt); // Close statement
                                    } else {
                                        echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                    }
                                ?>


                                                <?php
                                            if ($erro == false) {
                                                $stmt2 = mysqli_stmt_init($link);
                                                $query2 = "SELECT idUtilizadores, nome  FROM utilizadores WHERE Perfis_idPerfis = 3";
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {

                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $id_utilizadores, $nome);


                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($id_utilizadores == $id_users) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = " ";
                                                            }

                                                            echo "
                                    <option value='$id_utilizadores' $selected >$nome</option>
                                        ";
                                                        }
                                                    }
                                                }
                                                mysqli_stmt_close($stmt2);
                                                ?>

                                                </select>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info">Submeter alterações
                                                    </button>
                                                </div>
                                                </form>

                                                <?php
                                            }
                                mysqli_close($link); // Close connection
                                }?>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Food Rescue 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>


