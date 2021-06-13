<nav class="navbar  navbar-light fixed-bottom py-3" id="BotomNav">
    <div class="container">

        <?php  $paginaLink = basename($_SERVER['SCRIPT_NAME']);

        if ($paginaLink== 'index_chat.php' || $paginaLink== 'chat_contactos.php'){
            echo'<a href="chat_contactos.php"><i class="fas fa-comment fa-2x icons" style="color: #027381;" aria-label="Icon chat"></i></a>';
        }
        else{
            echo '<a href="chat_contactos.php"><i class="fas fa-comment fa-2x icons" aria-label="Icon chat"></i></a>';
        }
        if ($paginaLink== 'mapa.php'){
            echo'<a href="mapa.php"><i class="fas fa-location-arrow fa-2x icons" style="color: #027381;" aria-label="Icon mapa"></i></a>';
        }
        else{
            echo '<a href="mapa.php"><i class="fas fa-location-arrow fa-2x icons" aria-label="Icon mapa"></i></a>';
        }

        if ($paginaLink== 'perfil.php'){
            echo'<a href="perfil.php"><i class="fas fa-user-alt fa-2x icons" style="color: #027381;" aria-label="Icon perfil"></i></a>' ;
        }
        else{
            echo '<a href="perfil.php"><i class="fas fa-user-alt fa-2x icons" aria-label="Icon perfil"></i></a>';
        }

        ?>

        <a class="menu-toggle rounded" href="#">
            <i class="fas fa-bars fa-2x icons" aria-label="Icon menu"></i>
        </a>

        <nav id="sidebar-wrapper" >
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a class="js-scroll-trigger" href="#page-top"><span class="ml-2">Menu</span></a>
                </li>
                <li class="sidebar-nav-item ml-1">
                    <a class="js-scroll-trigger" href="mapa.php">Mapa</a>
                </li>
                <li class="sidebar-nav-item ml-1">
                    <a class="js-scroll-trigger" href="perfil.php">Perfil</a>
                </li>
                <li class="sidebar-nav-item ml-1">
                    <a class="js-scroll-trigger" href="chat_contactos.php">Chat</a>
                </li>
                <br>
                <li class="sidebar-nav-item ml-5">
                    <a class="js-scroll-trigger text-white ml-0" href="scripts/sc_logout.php"><span class="bg-danger p-2 logoutborder"><i
                                    class="fas fa-sign-out-alt" aria-label="Icon logout"></i> Logout</span></a>
                </li>
            </ul>
        </nav>

    </div>
</nav>
<?php
