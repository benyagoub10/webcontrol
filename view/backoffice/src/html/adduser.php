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

$error = "";

// create user
$user = null;

// create an instance of the controller
$userC = new userC();
if (
  isset($_POST["nom"]) &&
  isset($_POST["prenom"]) &&
  isset($_POST["email"]) &&
  isset($_POST["password"]) &&
  isset($_POST["age"]) &&
  isset($_POST["type"])
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST['prenom']) &&
    !empty($_POST["email"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["age"]) &&
    !empty($_POST["type"])
  ) {
    $user = new user(
      $_POST['nom'],
      $_POST['prenom'],
      $_POST['email'],
      $_POST['password'],
      $_POST['age'],
      $_POST['type']
    );
    $userC->create($user);
  } else
    $error = "Missing information";
}
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
          <div class="card-body">
            <h5 class="card-title mt-5 fw-semibold mb-4">Ajouter un utilisateur</h5>
            <div class="mt-5 card">
              <div class="card-body">
                <form action="" id="formr" method="post">
                  <div class="mb-3">
                    <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                    <span id="nomr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Prenom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                    <span id="prenomr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Age :</label>
                    <input min=8 max=90 type="number" class="form-control" id="age" name="age">
                    <span id="ager"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <span id="emailr"></span>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <span id="passwordr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Type :</label>
                    <select name="type" class="form-control" id="typeinput">
                      <option value="admin">admin</option>
                      <option value="participant">participant</option>
                      <option value="organisateur">organisateur</option>
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
        let lnameinput = document.getElementById('prenom');
        let age = document.getElementById('age');
        let pw = document.getElementById('password');
        let email = document.getElementById('email');
        const regex = /^[a-zA-Z-\s]+$/;
        if (lnameinput.value === '') {
          let lnameer = document.getElementById('prenomr');
          lnameer.innerHTML = "le champs prenom est vide . ";
          lnameer.style.color = 'red';
          e.preventDefault();
        } else if (!(regex.test(lnameinput.value))) {
          let lnameer = document.getElementById('nomr');
          lnameer.innerHTML = "le prenom doit comporter des lettres,et tirets seulements.";
          lnameer.style.color = 'red';
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
        ////////////
        if (pw.value === '') {
          let pwr = document.getElementById('passwordr');
          pwr.innerHTML = "le champs mot de pass est vide . ";
          pwr.style.color = 'red';
          e.preventDefault();
        }
        if (email.value === '') {
          let emailr = document.getElementById('emailr');
          emailr.innerHTML = "le champs email est vide . ";
          emailr.style.color = 'red';
          e.preventDefault();
        }
        if (age.value === '') {
          let ager = document.getElementById('ager');
          ager.innerHTML = "le champs age est vide . ";
          ager.style.color = 'red';
          e.preventDefault();
        } else if (!(/^[1-9]+$/.test(age.value))) {
          let ager = document.getElementById('ager');
          ager.innerHTML = "l age doit comporter que des numero";
          ager.style.color = 'red';
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