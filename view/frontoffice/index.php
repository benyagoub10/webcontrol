<?php
session_start();
include('../../config.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (!empty($email) && !empty($password) && !is_numeric($email)) {

		//read from database
		$query = "select * from users where email = '$email' limit 1";
		$db = config::getConnexion();
		try {
			$liste = $db->query($query);
			$u = $liste->fetch();
			if ($u) {
				if ($u['password'] === $password) {
					$_SESSION['type'] = $u['type'];
					$_SESSION['nom'] = $u['nom'];
					$_SESSION['email'] = $u['email'];
					$_SESSION['prenom'] = $u['prenom'];
					$_SESSION['id'] = $u['id'];
					header("Location: evenments.php");
					die;
				}
			}
		} catch (Exception $e) {
			die('Erreur:' . $e->getMessage());
		}
		echo "wrong username or password!";
	} else {
		echo "wrong username or password!";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Fruitkha</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Platforme evenements</p>
							<h1>Connectez-vous</h1>
							<div class="hero-btns">
								<form action="" method="post">
									<div class="mb-3">
										<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
									</div>
									<div class="mb-4">
										<input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
									</div>
									<button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>