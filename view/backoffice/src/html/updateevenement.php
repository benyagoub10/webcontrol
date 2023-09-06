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
include('../../../../controller/evenementC.php');

$error = "";

$categorieC = new categorieC();
$categories = $categorieC->read();

// create an instance of the controller
$evenementC = new evenementC();
// create evenement
$id = $_GET['update'];
$evenement = $evenementC->findone($id);
if (
  isset($_POST["nom"]) &&
  isset($_POST["description"]) &&
  isset($_POST["lieu"]) &&
  isset($_POST["categorie"])
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST['description']) &&
    !empty($_POST['lieu']) &&
    !empty($_POST["categorie"])
  ) {
    $evenement = new evenements(
      $_POST['nom'],
      $_POST['description'],
      $_POST['categorie'],
      $_POST['lieu'],
      0,
    );
    $evenementC->update($evenement, $id);
  } else
    $error = "Missing information";
}
?>
<!doccategorie html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" categorie="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
  </head>

  <body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebarcategorie="full" data-sidebar-position="fixed" data-header-position="fixed">
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
            <div class="card-body">
              <h5 class="card-title mt-5 fw-semibold mb-4">Modifier un evenement</h5>
              <div class="mt-5 card">
                <div class="card-body">
                  <form action="" id="formr" method="post">
                    <div class="mb-3">
                      <label class="form-label">Nom :</label>
                      <input type="text" value="<?= $evenement['nom'] ?>" class="form-control" id="nom" name="nom">
                      <span id="nomr"></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Description :</label>
                      <input type="text" value="<?= $evenement['description'] ?>" class="form-control" id="description" name="description">
                      <span id="descriptionr"></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Lieu :</label>
                      <input type="text" value="<?= $evenement['lieu'] ?>" class="form-control" id="lieu" name="lieu">
                      <span id="lieur"></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">categorie :</label>
                      <select name="categorie" class="form-control" id="categorieinput">
                        <?php
                        foreach ($categories as $t) {
                        ?>
                          <option value="<?= $t['id'] ?>"><?= $t['nom'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        let myform = document.getElementById('formr');
        myform.addEventListener('submit', function(e) {
          let nameinput = document.getElementById('nom');
          let description = document.getElementById('description');
          let lieu = document.getElementById('lieu');
          const regex = /^[a-zA-Z-\s]+$/;
          if (description.value === '') {
            let descriptionr = document.getElementById('descriptionr');
            descriptionr.innerHTML = "le champs prenom est vide . ";
            descriptionr.style.color = 'red';
            e.preventDefault();
          } else if (!(regex.test(description.value))) {
            let descriptionr = document.getElementById('nomr');
            descriptionr.innerHTML = "le prenom doit comporter des lettres,et tirets seulements.";
            descriptionr.style.color = 'red';
            e.preventDefault();
          }
          if (nameinput.value === '') {
            let nameer = document.getElementById('nomr');
            nameer.innerHTML = "le champs nom est vide . ";
            nameer.style.color = 'red';
            e.preventDefault();
          } else if (!(regex.test(nameinput.value))) {
            let nameer = document.getElementById('nomr');
            nameer.innerHTML = "le nom doit comporter des lettres,et tirets seulements.";
            nameer.style.color = 'red';
            e.preventDefault();
          }
          if (lieu.value === '') {
            let lieur = document.getElementById('lieur');
            lieur.innerHTML = "le champs lieu est vide . ";
            lieur.style.color = 'red';
            e.preventDefault();
          }
        });
      </script>
      <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/js/sidebarmenu.js"></script>
      <script src="../assets/js/app.min.js"></script>
      <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="../assets/js/dashboard.js"></script>
  </body>

  </html>