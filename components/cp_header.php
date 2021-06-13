<nav class="navbar navbar-light fixed-top " id="TopNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger  text-white " href="#"><img src="img/logo_foodrescue.png" alt="logo food rescue"></a>
        <?php
        session_start();

        $paginaLink = basename($_SERVER['SCRIPT_NAME']);

        if ($paginaLink== 'contactos.php'){
            echo'<a href="notifications.php"><i class="fas fa-bell fa-2x icons" style="color: #027381;" aria-label="Icon notificações"></i></a>';
        }
        else{
            require_once("connections/connection.php");

            $id_user = $_SESSION['iduser'];

            $link = new_db_connection();

            $stmt = mysqli_stmt_init($link);

            $query = "SELECT count(idNotificacoes), estado FROM notificacoes
              WHERE Utilizadores_idUtilizadores = ? and estado = 1";

            if( mysqli_stmt_prepare($stmt,$query) ) {

                mysqli_stmt_bind_param($stmt, 'i', $id_user);

                if (mysqli_stmt_execute($stmt)) {

                    mysqli_stmt_bind_result($stmt, $idnot, $estado);

                    while (mysqli_stmt_fetch($stmt)) {
                        if ($estado == 1){

                            echo '<div class="text-white" id="countnotif" style=" font-size: 0.8rem;
position: absolute; top: 14px;right: 20.7px; z-index: 3"></div>
<i class="fas fa-circle fa-1x icons" style="color: #F5211B ; position: absolute; top: 15px;right: 17px;" aria-label="Icon notificações"></i>';
                        }
                    }
                }
                mysqli_stmt_close($stmt);
            }
            mysqli_close($link);
            echo '<a href="notifications.php"><i class="fas fa-bell fa-2x icons" aria-label="Icon notificações"></i></a>';
        }
        ?>
    </div>
</nav>
<br><br><br>