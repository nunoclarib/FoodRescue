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
                    <h1 class="h3 mb-0 text-gray-800">Gestão da Grandeza</h1>
                    </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edição da Grandeza
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <?php
                                $erro = false;
                                require_once '../connections/connection.php';
                                if (isset($_GET['id_grandeza'])) {
                                    $id_grandeza = $_GET['id_grandeza'];


                                    $link = new_db_connection(); // Create a new DB connection

                                    $stmt = mysqli_stmt_init($link); // create a prepared statement


                                    $query = "SELECT grandeza, abreviatura_gr FROM grandezas WHERE idGrandezas=?"; // Define the query

                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                                        mysqli_stmt_bind_param($stmt, 'i', $id_grandeza);
                                        mysqli_stmt_execute($stmt); // Execute the prepared statement


                                        mysqli_stmt_bind_result($stmt, $grandeza, $abreviatura); // Bind results


                                        if (!mysqli_stmt_fetch($stmt)) {
                                            $erro = true;
                                            require_once "404.php";
                                        }
                                        else{
                                            ?>

                                            <form role="form" method="post" action="../scripts/sc_grandezas_update.php">
                                                <input type="hidden" name="id_grandeza" value="<?= $id_grandeza ?>">
                                                <div class="form-group">
                                                    <label>ID da Grandeza</label>
                                                    <p class="form-control-static"><?= $id_grandeza ?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Grandeza</label>
                                                    <input class="form-control" name="grandeza"
                                                           value="<?= $grandeza ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" name="abreviatura"
                                                           value="<?= $abreviatura ?>">
                                                </div>
                                                <button type="submit" class="btn btn-info">Submeter alterações
                                                </button>
                                            </form>
                                            <?php
                                        }
                                        mysqli_stmt_close($stmt); // Close statement
                                    } else {
                                        echo("Error description: " . mysqli_error($link));   //mensagem de erro
                                    }

                                    mysqli_close($link); // Close connection
                                }
                                ?>
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
