<?php

if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "O ficheiro é muito grande, terá de ter menos de 13MB!";
            $class = "alert-warning";
            $upload = true;
            break;
        case 1:
            $message = "Erro ao realizar o upload.";
            $class = "alert-danger";
            $upload = true;
            break;
        case 2:
            $message = "Este tipo de ficheiro não é suportado.";
            $class = "alert-warning";
            $upload = true;
            break;
        case 3:
            $message = "Não foi submetido nenhum ficheiro...";
            $class = "alert-warning";
            $upload = true;
            break;
        default:
            $msg_show = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet"/>

    <link rel="stylesheet" href="../css/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet"/>
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


                <div class="main-panel">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                        <div class="container-fluid">

                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Perfil Administrador</h1>
                            </div>

                        </div>
                    </nav>
                    <!-- End Navbar -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header card-header-info">
                                            <h4 class="card-title ">Perfil</h4>
                                            <p class="card-category">Editar Perfil</p>
                                        </div>
                                        <div class="card-body">
                                            <?php

                                            if (isset($_SESSION['iduser'])) {
                                                $iduser = $_SESSION['iduser'];

                                                include_once "../connections/connection.php";

                                                $link = new_db_connection(); // Create a new DB connection

                                                $stmt = mysqli_stmt_init($link); // create a prepared statement
                                                $query = "Select nome, apelido, email, contacto, foto_pessoal, username FROM utilizadores WHERE idUtilizadores=?";
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    mysqli_stmt_bind_param($stmt, "i", $iduser);
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $nome, $apelido, $email, $contacto, $fotografia, $username);
                                                        if (mysqli_stmt_fetch($stmt)) {
                                                            ?>
                                                            <?php
                                                            if (isset($_GET["msg"]) && $upload == true) {
                                                                echo "<br><div id='alertmsg' class=\"alert $class alert-dismissible fade show\" role=\"alert\">
                 " . $message . "
                 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                 <span aria-hidden=\"true\">&times;</span>
                 </button>
                 </div>";
                                                                if ($msg_show) {
                                                                    echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                                                }
                                                            } ?>
                                                            <div class="text-center">
                                                                <form method="post"
                                                                      action="../upload_fotoperfil_adm.php"
                                                                      enctype="multipart/form-data">
                                                                    <input type="file" name="fileupload"><br><br>
                                                                    <div>
                                                                        <button type="submit" name="submit"
                                                                                class="btn btn-info">Submeter imagem
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <form method="post"
                                                                  action="../scripts/sc_perfilad_update.php">
                                                                <br>
                                                                <div class="card card-profile">
                                                                    <div class="card-avatar">
                                                                        <a href="javascript:;">
                                                                            <?php

                                                                            $id_user = $_SESSION['iduser'];

                                                                            $link = new_db_connection(); // Create a new DB connection

                                                                            $stmt2 = mysqli_stmt_init($link); // create a prepared statement

                                                                            $query = "SELECT foto_pessoal FROM utilizadores WHERE idUtilizadores = ?"; // Define the query

                                                                            if (mysqli_stmt_prepare($stmt2, $query)) { // Prepare the statement

                                                                                mysqli_stmt_bind_param($stmt2, 'i', $id_user);

                                                                                mysqli_stmt_execute($stmt2); // Execute the prepared statement

                                                                                mysqli_stmt_bind_result($stmt2, $imagem);

                                                                                while (mysqli_stmt_fetch($stmt2)) {
                                                                                    if ($imagem != NULL) {

                                                                                        echo '<img src="../uploads/' . $imagem . '">';
                                                                                    } else {
                                                                                        echo '<img src="../img/img_avatar.png">';
                                                                                    }
                                                                                }

                                                                                mysqli_stmt_close($stmt2); // Close statement
                                                                            } else {
                                                                                echo("Error description: " . mysqli_error($link));
                                                                            }

                                                                            ?>

                                                                        </a>
                                                                    </div>

                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-md-12 text-center">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating">Nome</label>
                                                                            <input type="text" name="nome"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating">Apelido</label>
                                                                            <input type="text" name="apelido"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating">Username</label>
                                                                            <input type="text" name="username"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating ">Contacto</label>
                                                                            <input type="text" name="contacto"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating">Email</label>
                                                                            <input type="email" name="email"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <button type="submit" class="btn btn-info pull-right">
                                                                    Submeter Alterações
                                                                </button>
                                                                <div class="clearfix"></div>
                                                            </form>

                                                            <?php
                                                        } else {
                                                            echo "Error:" . mysqli_stmt_error($stmt);
                                                        }
                                                        mysqli_stmt_close($stmt);
                                                        mysqli_close($link);
                                                    } else {

                                                        echo "Error: " . mysqli_stmt_error($stmt);
                                                    };

                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                    mysqli_close($link);

                                                };
                                            } else {
                                                header("Location:../perfil.php");

                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--   Core JS Files   -->
            <script src="../assets/js/core/jquery.min.js"></script>
            <script src="../assets/js/core/popper.min.js"></script>
            <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
            <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            <!-- Plugin for the momentJs  -->
            <script src="../assets/js/plugins/moment.min.js"></script>
            <!--  Plugin for Sweet Alert -->
            <script src="../assets/js/plugins/sweetalert2.js"></script>
            <!-- Forms Validations Plugin -->
            <script src="../assets/js/plugins/jquery.validate.min.js"></script>
            <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
            <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
            <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
            <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
            <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
            <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
            <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
            <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
            <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
            <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
            <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
            <script src="../assets/js/plugins/fullcalendar.min.js"></script>
            <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
            <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
            <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
            <script src="../assets/js/plugins/nouislider.min.js"></script>
            <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
            <!-- Library for adding dinamically elements -->
            <script src="../assets/js/plugins/arrive.min.js"></script>
            <!--  Google Maps Plugin    -->
            <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
            <!-- Chartist JS -->
            <script src="../assets/js/plugins/chartist.min.js"></script>
            <!--  Notifications Plugin    -->
            <script src="../assets/js/plugins/bootstrap-notify.js"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
            <!-- Material Dashboard DEMO methods, don't include it in your project! -->
            <script src="../assets/demo/demo.js"></script>
            <script>
                $(document).ready(function () {
                    $().ready(function () {
                        $sidebar = $('.sidebar');

                        $sidebar_img_container = $sidebar.find('.sidebar-background');

                        $full_page = $('.full-page');

                        $sidebar_responsive = $('body > .navbar-collapse');

                        window_width = $(window).width();

                        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                                $('.fixed-plugin .dropdown').addClass('open');
                            }

                        }

                        $('.fixed-plugin a').click(function (event) {
                            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                            if ($(this).hasClass('switch-trigger')) {
                                if (event.stopPropagation) {
                                    event.stopPropagation();
                                } else if (window.event) {
                                    window.event.cancelBubble = true;
                                }
                            }
                        });

                        $('.fixed-plugin .active-color span').click(function () {
                            $full_page_background = $('.full-page-background');

                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-color', new_color);
                            }

                            if ($full_page.length != 0) {
                                $full_page.attr('filter-color', new_color);
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.attr('data-color', new_color);
                            }
                        });

                        $('.fixed-plugin .background-color .badge').click(function () {
                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('background-color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-background-color', new_color);
                            }
                        });

                        $('.fixed-plugin .img-holder').click(function () {
                            $full_page_background = $('.full-page-background');

                            $(this).parent('li').siblings().removeClass('active');
                            $(this).parent('li').addClass('active');


                            var new_image = $(this).find("img").attr('src');

                            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                $sidebar_img_container.fadeOut('fast', function () {
                                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                    $sidebar_img_container.fadeIn('fast');
                                });
                            }

                            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $full_page_background.fadeOut('fast', function () {
                                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                    $full_page_background.fadeIn('fast');
                                });
                            }

                            if ($('.switch-sidebar-image input:checked').length == 0) {
                                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                            }
                        });

                        $('.switch-sidebar-image input').change(function () {
                            $full_page_background = $('.full-page-background');

                            $input = $(this);

                            if ($input.is(':checked')) {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar_img_container.fadeIn('fast');
                                    $sidebar.attr('data-image', '#');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page_background.fadeIn('fast');
                                    $full_page.attr('data-image', '#');
                                }

                                background_image = true;
                            } else {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar.removeAttr('data-image');
                                    $sidebar_img_container.fadeOut('fast');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page.removeAttr('data-image', '#');
                                    $full_page_background.fadeOut('fast');
                                }

                                background_image = false;
                            }
                        });

                        $('.switch-sidebar-mini input').change(function () {
                            $body = $('body');

                            $input = $(this);

                            if (md.misc.sidebar_mini_active == true) {
                                $('body').removeClass('sidebar-mini');
                                md.misc.sidebar_mini_active = false;

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                            } else {

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                                setTimeout(function () {
                                    $('body').addClass('sidebar-mini');

                                    md.misc.sidebar_mini_active = true;
                                }, 300);
                            }

                            // we simulate the window Resize so the charts will get updated in realtime.
                            var simulateWindowResize = setInterval(function () {
                                window.dispatchEvent(new Event('resize'));
                            }, 180);

                            // we stop the simulation of Window Resize after the animations are completed
                            setTimeout(function () {
                                clearInterval(simulateWindowResize);
                            }, 1000);

                        });
                    });
                });
            </script>
</body>

</html>
