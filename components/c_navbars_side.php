<?php
// Verificação de credenciais de acesso à área de administração

?>

<!-- Sidebar -->

<ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="../img/foodrescueadm.png" alt="logo food rescue" height="60" width="60">
        </div>
        <div class="sidebar-brand-text mx-3">FoodRescue <sup>admin tool</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="perfil.php">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Perfil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestão
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="users.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Utilizadores</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="org.php">
            <i class="fas fa-fw fa-flag"></i>
            <span>Organizações</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="estabelecimentos.php">
            <i class="fas fa-fw fa-utensils"></i>
            <span>Estabelecimentos</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="grandezas.php">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>Grandezas</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
