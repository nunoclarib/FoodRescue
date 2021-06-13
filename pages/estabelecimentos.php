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
            require_once "../components/c_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão dos Estabelecimentos</h1>
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
                                Estabelecimentos Registados
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <br>

                                    <form action="estabelecimentos.php?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=i"
                                          method="get"
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

                                    <?php
                                    require_once '../connections/connection.php';

                                    if (isset($_GET['sort'])) {
                                        $sort = $_GET['sort'];

                                        switch ($sort) {
                                            case 'i';
                                                $categoria = 'idEstabelecimentos ';
                                                break;
                                            case 'n';
                                                $categoria = 'nome_estab ';
                                                break;
                                            case 'm';
                                                $categoria = 'morada ';
                                                break;
                                            case 'ha';
                                                $categoria = 'hora_abertura ';
                                                break;
                                            case 'hf';
                                                $categoria = 'hora_fecho ';
                                                break;
                                            case 'p';
                                                $categoria = 'utilizadores.nome ';
                                                break;
                                        }
                                    } else {
                                        $categoria = 'idEstabelecimentos ';
                                    }

                                    if (isset($_GET["search"]) && $_GET["search"] !== '') {

                                        $search = $_GET["search"] . '%';
                                    } else {
                                        $search = '%';
                                    }

                                    $link = new_db_connection();

                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT idEstabelecimentos, nome_estab, morada, descricao, hora_abertura, hora_fecho, fot_estab, 
                              latitude, longitude, Utilizadores_idUtilizadores, utilizadores.nome FROM estabelecimentos
                              INNER JOIN utilizadores ON estabelecimentos.Utilizadores_idUtilizadores=utilizadores.idUtilizadores
                              WHERE nome_estab LIKE ? OR morada LIKE ? OR utilizadores.nome LIKE ?
                              ORDER BY " . $categoria . $ordem;

                                    if (mysqli_stmt_prepare($stmt, $query)) {

                                    mysqli_stmt_bind_param($stmt, 'sss', $search, $search, $search);

                                    mysqli_stmt_execute($stmt);

                                    mysqli_stmt_bind_result($stmt, $id_estab, $nome_estab, $morada_estab, $descricao, $hora_ab, $hora_f, $foto_estab, $latitude, $longitude, $id_utilizadores, $nome); // Bind results

                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th><i class="fa <?= $class ?> text-info" aria-hidden="true"></i></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=i"
                                                   class="text-info">Id</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=n"
                                                   class="text-info">Nome</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=m"
                                                   class="text-info">Morada</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=d"
                                                   class="text-info">Descrição</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=ha"
                                                   class="text-info">Abertura</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=hf"
                                                   class="text-info">Fecho</a></th>
                                            <th>Fotografia</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?= $ordem ?>&sort=p"
                                                   class="text-info">Proprietário</a></th>
                                            <th>Operações</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        while (mysqli_stmt_fetch($stmt)) { // Fetch values?>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><?= $id_estab ?></td>
                                                <td><?= $nome_estab ?></td>
                                                <td><?= $morada_estab ?></td>
                                                <td><?= $descricao ?></td>
                                                <td><?= $hora_ab ?></td>
                                                <td><?= $hora_f ?></td>
                                                <td><?= $foto_estab ?></td>
                                                <td><?= $latitude ?></td>
                                                <td><?= $longitude ?></td>
                                                <td><?= $nome ?></td>
                                                <td>
                                                    <a href='estabelecimentos_edit.php?id_estab=<?= $id_estab ?>'><i
                                                                class="far fa-edit pr-3 text-info"></i></a>
                                                    <a href="../scripts/sc_estab_delete.php?id_estab=<?= $id_estab ?>"
                                                       class="text-danger"><i class="far fa-trash-alt text-danger"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php

                                        }
                                        $_GET['id_estab'] = $id_estab;

                                        mysqli_stmt_close($stmt); // Close statement
                                        } else {
                                            echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                        }
                                        mysqli_close($link); // Close connection

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
                                                        <br> este estabelecimento ?</p>
                                                </div>


                                                <!--Footer-->
                                                <div class="modal-footer justify-content-center">
                                                    <a href="../scripts/sc_estab_delete.php?id_estab=<?= $id_estab ?>"
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
                            <br>
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


