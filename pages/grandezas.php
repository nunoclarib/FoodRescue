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
                    <h1 class="h3 mb-0 text-gray-800">Gestão de Grandezas</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <?php

                    if (isset($_GET['ordem'])) {
                        $ordem = $_GET['ordem'];

                        if ($ordem == ' DESC') {
                            $ordem = ' ASC';
                            $class = 'fa-sort-alpha-down';
                        } else {
                            $ordem = ' DESC';
                            $class = 'fa-sort-alpha-up';
                        }
                    } else {
                        $ordem = ' ASC';
                        $class = 'fa-sort-alpha-down';
                    }
                    if (isset($_GET["search"]) && $_GET["search"] !== '') {
                        $search = $_GET["search"];

                    } else {
                        $search = '';
                    }
                    ?>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grandezas Registadas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <br>

                                    <form action="grandezas.php?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=i" method="get"
                                          class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" name="search"
                                                   class="form-control bg-light border-0 small"
                                                   placeholder="Pesquisar..."
                                                   aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>


                                        </div>
                                    </form>

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=i"
                                                   class="text-info">Id</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=g"
                                                   class="text-info">Grandeza</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=a"
                                                   class="text-info">Abreviatura</a></th>
                                            <th>Operações</th>
                                        </tr>
                                        </thead>

                                        <?php
                                        require_once '../connections/connection.php';

                                        if (isset($_GET['sort'])) {
                                            $sort = $_GET['sort'];

                                            switch ($sort) {
                                                case 'i';
                                                    $categoria = 'idGrandezas ';
                                                    break;
                                                case 'g';
                                                    $categoria = 'grandeza ';
                                                    break;
                                                case 'a';
                                                    $categoria = 'abreviatura_gr ';
                                                    break;
                                            }
                                        } else {
                                            $categoria = 'idGrandezas ';
                                        }

                                        if (isset($_GET["search"]) && $_GET["search"] !== '') {

                                            $search = $_GET["search"] . '%';
                                        } else {
                                            $search = '%';
                                        }

                                        if (isset($_SESSION["username"]) && isset($_SESSION["perfil"]) && $_SESSION["perfil"] == 1) {


                                            $link = new_db_connection(); // Create a new DB connection

                                            $stmt = mysqli_stmt_init($link); // create a prepared statement

                                            $query = "SELECT idGrandezas, grandeza, abreviatura_gr FROM grandezas
                                            WHERE grandeza LIKE ? OR abreviatura_gr LIKE ?
                                            ORDER BY ".$categoria.$ordem; // Define the query

                                            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                                mysqli_stmt_bind_param($stmt, 'ss', $search, $search);

                                                mysqli_stmt_execute($stmt); // Execute the prepared statement

                                                mysqli_stmt_bind_result($stmt, $id_grandeza, $grandeza, $abreviatura); // Bind results

                                                while (mysqli_stmt_fetch($stmt)) { // Fetch values?>
                                                    <tbody>
                                                    <tr>
                                                        <td><?= $id_grandeza ?></td>
                                                        <td><?= $grandeza ?></td>
                                                        <td><?= $abreviatura ?></td>
                                                        <td>
                                                            <a href='grandezas_edit.php?id_grandeza=<?= $id_grandeza ?>'><i
                                                                        class="far fa-edit pr-3 text-info"></i></a>

                                                            <a href="../scripts/sc_grandezas_delete.php?id_grandeza=<?= $id_grandeza ?>"
                                                               class="text-danger"><i
                                                                        class="far fa-trash-alt text-danger"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <?php

                                                }

                                                $_GET['id_grandeza']=$id_grandeza;

                                                mysqli_stmt_close($stmt);
                                            } else {
                                                echo("Error description: " . mysqli_error($link));
                                            }
                                            mysqli_close($link);
                                        }
                                        ?>
                                    </table>
                                    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                                            <!--Content-->
                                            <div class="modal-content text-center">
                                                <!--Header-->
                                                <div class="modal-header d-flex justify-content-center bg-danger text-white">
                                                    <p class="heading">Tem a certeza que quer eliminar
                                                        <br>esta grandeza ?</p>
                                                </div>


                                                <!--Footer-->
                                                <div class="modal-footer justify-content-center">
                                                    <a href="../scripts/sc_grandezas_delete.php?id_grandeza=<?= $id_grandeza ?>"
                                                       class="btn  btn-outline-success">Eliminar</a>
                                                    <a type="button" class="btn  btn-danger waves-effect text-white"
                                                       data-dismiss="modal">Cancelar</a>
                                                </div>
                                            </div>
                                            <!--/.Content-->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info"><a href="grandezas_add.php" class="text-white">Adicionar
                                        Grandeza</a>
                                </button>
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

