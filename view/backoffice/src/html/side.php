<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <?php
        if ($_SESSION['type'] == "admin") {
            echo ('<li class="sidebar-item">
            <a class="sidebar-link" href="./users.php" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Gerer utilisateur</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./categories.php" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Gerer categorie</span>
            </a>
        </li>');
        }
        ?>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./evenements.php" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Gerer evenement</span>
            </a>
        </li>
    </ul>
</nav>
<!-- End Sidebar navigation -->