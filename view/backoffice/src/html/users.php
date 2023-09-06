<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
} else if ($_SESSION['type'] == "participant") {
  header("Location:login.php");
}

if (isset($_GET['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect to the login page
  header("Location: login.php");
}
include('../../../../controller/userC.php');

if (isset($_GET['search'])) {
  $userC = new userC();
  $users = $userC->search($_GET['search']);
} else if (isset($_GET['sort'])) {
  $userC = new userC();
  $users = $userC->sort($_GET['sort']);
} else {
  $userC = new userC();
  $users = $userC->read();
}
$userC->delete();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href=# class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <?php include("side.php") ?>
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="?logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <br>
          <h1 class="mt-5">Gerer les utilisateurs</h1>
          <br><br>
          <div class="mt-5">
            <div class="row">
              <div class="col-6">
                <a class="btn btn-primary" href="adduser.php">ajouter utilisateur</a>
              </div>
              <div class="col-6">
                <form action="?search" method="get">
                  <input type="text" class=" form-control" placeholder="Chercher .. " name="search">
                </form>
              </div>
            </div>
          </div>
          <table class="table mt-5">
            <thead>
              <tr>
                <th scope="col"><a href="?sort=id">#</a></th>
                <th scope="col"><a href="?sort=nom">Nom</a></th>
                <th scope="col"><a href="?sort=prenom">Prenom</a></th>
                <th scope="col"><a href="?sort=email">Email</a></th>
                <th scope="col"><a href="?sort=age">Age</a></th>
                <th scope="col"><a href="?sort=type">Type</a></th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($users as $u) {
              ?>
                <tr>
                  <th scope="row"><?= $u['id'] ?></th>
                  <td><?= $u['nom'] ?></td>
                  <td><?= $u['prenom'] ?></td>
                  <td><?= $u['email'] ?></td>
                  <td><?= $u['age'] ?></td>
                  <td><?= $u['type'] ?></td>
                  <td><a href="?delete=<?= $u['id'] ?>">supprimer</a> || <a href="updateuser.php?update=<?= $u['id'] ?>">modifier</a></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>