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
                    <h1 class="h3 mb-0 text-gray-800">Gestão de Utilizadores</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Utilizadores Registados
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <br>
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
                                    }
                                    else{
                                        $ordem = ' ASC';
                                        $class = 'fa-sort-alpha-down';
                                    }

                                    if (isset($_GET["search"]) && $_GET["search"] !=='' ) {
                                        $search = $_GET["search"];

                                    }
                                    else{
                                        $search = '';
                                    }
                                    ?>
                                    <form action="users.php?search=<?= $search ?>&ordem=<?=$ordem?>&sort=i" method = "get"
                                          class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" name ="search"
                                                   class="form-control bg-light border-0 small" placeholder="Pesquisar..."
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
                                            <th><i class="fa <?= $class ?> text-info" aria-hidden="true"></i></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=i" class="text-info"> Id</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=u" class="text-info">Username</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=e" class="text-info">Email</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=c" class="text-info">Contacto</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=d" class="text-info">Data de Criação</a></th>
                                            <th><a href="?search=<?= $search ?>&ordem=<?=$ordem?>&sort=p" class="text-info">Perfil</a></th>
                                            <th>Operações</th>
                                        </tr>
                                        </thead>

                                        <?php
                            require_once '../connections/connection.php';

                            if (isset($_SESSION["username"]) && isset($_SESSION["perfil"]) && $_SESSION["perfil"] == 1) {

                                if (isset($_GET['sort'])) {
                                    $sort = $_GET['sort'];

                                    switch ($sort) {
                                        case 'i';
                                            $categoria = 'idUtilizadores ';
                                            break;
                                        case 'u';
                                            $categoria = 'username ';
                                            break;
                                        case 'e';
                                            $categoria = 'email ';
                                            break;
                                        case 'c';
                                            $categoria = 'contacto ';
                                            break;
                                        case 'd';
                                            $categoria = 'date_creation ';
                                            break;
                                        case 'p';
                                            $categoria = 'perfil ';
                                            break;
                                    }
                                }
                                else {
                                    $categoria = 'idUtilizadores ';
                                }

                                if (isset($_GET["search"]) && $_GET["search"] !=='' ) {

                                    $search = $_GET["search"] . '%';
                                }
                                else {
                                    $search = '%';
                                }

                                $link = new_db_connection(); // Create a new DB connection

                                $stmt = mysqli_stmt_init($link); // create a prepared statement

                                $query = "SELECT idUtilizadores, username, email, contacto, date_creation, perfil, active FROM utilizadores
                                      INNER JOIN Perfis ON Perfis_idPerfis = idPerfis WHERE username LIKE ? OR email LIKE ? OR contacto LIKE ? OR perfil LIKE ? ORDER BY ".$categoria.$ordem; // Define the query

                                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                    mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);

                                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                                    mysqli_stmt_bind_result($stmt, $id_user, $username, $email, $contacto, $data_criacao, $perfil, $active); // Bind results

                                    while (mysqli_stmt_fetch($stmt)) { // Fetch values?>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td><?= $id_user ?></td>
                                            <td><?php if ($active == 0) {
                                                    echo "<i class=\"fa fa-ban fa-fw\"></i>";
                                                } ?><?= $username ?></td>
                                            <td><?= $email ?></td>
                                            <td><?= $contacto ?></td>
                                            <td><?= $data_criacao ?></td>
                                            <td><?= $perfil ?></td>
                                            <td><a href='users_edit.php?id=<?= $id_user ?>'><i class="far fa-edit text-info pr-3"></i></a>
                                                <a  href="../scripts/sc_user_delete.php?id_user=<?= $id_user ?>" class="text-danger"><i class="far fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <?php
                                        $_GET['id_user'] = $id_user;

                                    }
                                    mysqli_stmt_close($stmt); // Close statement
                                } else {
                                    echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                }
                                mysqli_close($link); // Close connection
                            }
                                        ?>
                                    </table>
                                    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                                            <!--Content-->
                                            <div class="modal-content text-center">
                                                <!--Header-->
                                                <div class="modal-header d-flex justify-content-center bg-danger text-white">
                                                    <p class="heading">Tem a certeza que quer eliminar<br>este utilizador ?</p>
                                                </div>

                                                <!--Footer-->
                                                <div class="modal-footer justify-content-center">
                                                    <a href="../scripts/sc_user_delete.php?id_user=<?=$id_user?>" class="btn  btn-outline-success">Yes</a>
                                                    <a type="button" class="btn  btn-danger waves-effect text-white" data-dismiss="modal">No</a>
                                                </div>
                                            </div>
                                            <!--/.Content-->
                                        </div>
                                    </div>
                                </div>
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

