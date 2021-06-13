<!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administração Food Rescue</title>

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">

        <link rel="stylesheet" href="../css/fontawesome-free/css/all.css">

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

if($_SESSION['perfil']== 1){

                ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <!-- Earnings (Monthly) Card Example -->

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nº de
                                                Utilizadores Total
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php

                                                require_once '../connections/connection.php';

                                                $link = new_db_connection(); // Create a new DB connection

                                                $stmt = mysqli_stmt_init($link); // create a prepared statement


                                                $query = "SELECT COUNT(idUtilizadores) FROM utilizadores"; // Define the query

                                                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                                                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                                                    mysqli_stmt_bind_result($stmt, $num_utilizadores); // Bind results

                                                    if (mysqli_stmt_fetch($stmt)) { // Fetch values


                                                        echo $num_utilizadores;

                                                    }
                                                    mysqli_stmt_close($stmt); // Close statement
                                                } else {
                                                    echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nº de
                                                Voluntários
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <?php
                                                $stmt2 = mysqli_stmt_init($link); // create a prepared statement


                                                $query2 = "SELECT COUNT(idUtilizadores) FROM utilizadores WHERE Perfis_idPerfis = 2"; // Define the query

                                                if (mysqli_stmt_prepare($stmt2, $query2)) { // Prepare the statement
                                                    mysqli_stmt_execute($stmt2); // Execute the prepared statement

                                                    mysqli_stmt_bind_result($stmt2, $num_volunt); // Bind results

                                                    if (mysqli_stmt_fetch($stmt2)) { // Fetch values


                                                        echo $num_volunt;

                                                    }
                                                    mysqli_stmt_close($stmt2); // Close statement
                                                } else {
                                                    echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                                }


                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bicycle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nº de
                                                Fornecedores
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $stmt3 = mysqli_stmt_init($link); // create a prepared statement


                                                $query3 = "SELECT COUNT(idUtilizadores) FROM utilizadores WHERE Perfis_idPerfis = 3"; // Define the query

                                                if (mysqli_stmt_prepare($stmt3, $query3)) { // Prepare the statement
                                                    mysqli_stmt_execute($stmt3); // Execute the prepared statement

                                                    mysqli_stmt_bind_result($stmt3, $num_forn); // Bind results

                                                    if (mysqli_stmt_fetch($stmt3)) { // Fetch values


                                                        echo $num_forn;

                                                    }
                                                    mysqli_stmt_close($stmt3); // Close statement
                                                } else {
                                                    echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                                }


                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-utensils fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nº de
                                                Adminstradores
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $stmt4 = mysqli_stmt_init($link); // create a prepared statement


                                                $query4 = "SELECT COUNT(idUtilizadores) FROM utilizadores WHERE Perfis_idPerfis = 1"; // Define the query

                                                if (mysqli_stmt_prepare($stmt4, $query4)) { // Prepare the statement
                                                    mysqli_stmt_execute($stmt4); // Execute the prepared statement

                                                    mysqli_stmt_bind_result($stmt4, $num_admin); // Bind results

                                                    if (mysqli_stmt_fetch($stmt4)) { // Fetch values

                                                        echo $num_admin;

                                                    }
                                                    mysqli_stmt_close($stmt4); // Close statement
                                                } else {
                                                    echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                                }


                                                mysqli_close($link); // Close connection


                                                ?>


                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">

                            <div class="col-12 mb-4">

                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Informações da Aplicação</h6>
                                    </div>
                                    <div class="card-body">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                             src="../img/logo_foodrescue.png" alt="logotipo da aplicação">
                                        <p>Bem vindo à tua ferramenta de administração da Food Rescue! <br> Aqui poderás
                                            visualizar, editar,
                                            acrescentar ou eliminar dados relativos à base de dados das aplicação.
                                        </p>
                                    </div>
                                </div>


                                <!-- /.container-fluid -->

                            </div>
                            <!-- End of Main Content -->

                            <!-- Footer -->
                            <footer class="sticky-footer bg-white col-12">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; FoodRescue 2020</span>
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

                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Logout" below if you are ready to end your current
                                    session.
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="login.html">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

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
<?php }
else{
    include_once '404_v2.php';
}

?>

    </html>
